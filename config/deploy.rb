############################################
# Requirements
############################################

set :stages, %w(prd dev)
set :default_stage, "dev"
set :keep_releases, 2
require 'capistrano/ext/multistage'
require 'yaml'

after "deploy", "deploy:cleanup"


############################################
# Setup Site
############################################

set :site, "156312" # this is your site number, https://kb.mediatemple.net/questions/268/What+is+my+site+number%3F#gs
set :user, "joshuajohnson.co.uk"
set(:host) { "s#{site}.gridserver.com" }
set(:domain) { "s#{site}.gridserver.com" }
set(:user) { "serveradmin@#{application}" }

############################################
# Setup Git
############################################

set :repository, "git@github.com:jshjohnson/TARVA.git"
set :scm, :git
set(:git_enable_submodules, true)
set :deploy_via, :remote_cache
set :copy_exclude, [".git", ".DS_Store", ".gitignore", ".gitmodules", "capfile", "config/"]

############################################
# Setup Server
############################################

set :use_sudo, false
ssh_options[:forward_agent] = true

# Path stuff, make sure to symlink html to ./current
set(:deploy_to) { "/home/#{site}/users/.home/domains/#{application}" }
set(:current_deploy_dir) { "#{deploy_to}/current" }

# we need a relative path for the current symlink, without this
# current is set to link to the release starting from the /home directory
# which has a directory that is not owned by the serveradmin and apache
# won't have access
def relative_path(from_str, to_str)
  require 'pathname'
  Pathname.new(to_str).relative_path_from(Pathname.new(from_str)).to_s
end

############################################
# Recipies
############################################

# overwrite the symlink method to use the relative path method above
namespace :deploy do
  desc "Relative symlinks for current, so we don't use full path"
  task :create_symlink, :except => { :no_release => true } do
    if releases[-2] # not the first release
      previous_release_relative = relative_path(deploy_to, previous_release + '/')
      on_rollback { run "rm -f #{current_path}; ln -s #{previous_release_relative} #{current_path}; true" }
    end
    latest_release_relative = relative_path(deploy_to, latest_release + '/')
    run "rm -f #{current_path} && ln -s #{latest_release_relative} #{current_path}"
  end
end

### WordPress

namespace :wp do
	# desc "Setup symlinks for a WordPress project"
 #    task :create_symlinks, :roles => :app do
 #        run "ln -nfs #{shared_path}/uploads #{release_path}/content/uploads"
 #        run "ln -nfs #{shared_path}/wp-config.php #{release_path}/wp-config.php"
 #        # run "ln -nfs #{shared_path}/.htaccess-master #{release_path}/.htaccess"
 #    end

    desc "Create files and directories for WordPress environment"
    task :setup, :roles => :app do
        run "mkdir -p #{shared_path}/uploads"
        # run "touch #{shared_path}/.htaccess-master"
        secret_keys = capture("curl -s -k https://api.wordpress.org/secret-key/1.1/salt")
        wp_siteurl = Capistrano::CLI.ui.ask("#{stage} site URL: ")
        database = YAML::load_file('config/database.yml')[stage.to_s]

        db_config = ERB.new(File.read('./config/templates/wp-config.php.erb')).result(binding)
        accessfile = ERB.new(File.read('./config/templates/.htaccess.erb')).result(binding)

        put db_config, "#{release_path}/wp-config.php"
        put accessfile, "#{release}/.htaccess"
    end

    desc "Sets up WordPress wpconfig and .htaccess for your local environment"
    task :setup_local, :roles => :app do
        database = YAML::load_file('config/database.yml')['local']
        secret_keys = capture("curl -s -k https://api.wordpress.org/secret-key/1.1/salt")
        wp_siteurl = Capistrano::CLI.ui.ask("local site URL: ")
        db_config = ERB.new(File.read('./config/templates/wp-config.php.erb')).result(binding)
        accessfile = ERB.new(File.read('./config/templates/.htaccess.erb')).result(binding)

        puts "Creating local wp-config.php and .htaccess"
        File.open("wp-config.php", 'w') {|f| f.write(db_config) }
        File.open(".htaccess", 'w') {|f| f.write(accessfile) }

    end

    desc "Syncs WordPress Uploads directory to remote server"
    task :push_uploads, :roles => :app do
        system("rsync -ravz --delete --progress content/uploads/* #{user}@#{host}:#{shared_path}/uploads")
    end

    desc "Syncs WordPress Uploads directory to local server"
    task :pull_uploads, :roles => :app do
        system("mkdir content/uploads")
        system("rsync -ravz --delete --progress #{user}@#{host}:#{shared_path}/uploads/* content/uploads")
    end

end

after "deploy:setup", "wp:setup"

### Git

namespace :git do
    desc "Updates git submodule tags"
    task :submodule_tags do
        run "if [ -d #{shared_path}/cached-copy/ ]; then cd #{shared_path}/cached-copy/ && git submodule foreach --recursive git fetch origin --tags; fi"
    end

    desc "Reinitalises git repo and submodules"
    task :setup do
        system("bash config/bash/git_init.sh")
    end
end

before "deploy", "git:submodule_tags"

### Database

namespace :db do
    task :backup_name, :roles => :app do
        now = Time.now
        run "mkdir -p #{shared_path}/db_backups"
        backup_time = [now.year,now.month,now.day,now.hour,now.min,now.sec].join()
        set :backup_file, "#{shared_path}/db_backups/#{backup_time}.sql"
    end

    desc "Takes a database dump from remote server"
    task :dump do
        backup_name
        puts "Dumping remote database..."
        database = YAML::load_file('config/database.yml')[stage.to_s]
        run "mysqldump --add-drop-table -h #{database['host']} -u #{database['username']} -p#{database['password']} #{database['database']} > #{backup_file}"
    end

    desc "Syncs remote database to local database"
    task :sync_to_local do
        backup_name
        dump
        puts "Downloading remote backup..."
        get "#{backup_file}", "/tmp/#{application}.sql"
        puts "Removing remote backup..."
        run "rm #{backup_file}"
        database = YAML::load_file('config/database.yml')['local']
        puts "Importing into local database..."
        system("mysql -h #{database['host']} -u #{database['username']} -p#{database['password']} #{database['database']} < /tmp/#{application}.sql")
        puts "Removing local backup..."      
        system("rm /tmp/#{application}.sql")
    end

    desc "Syncs local database to remote database"
    task :sync_to_remote do
        backup_name
        puts "Dumping local database..."
        database = YAML::load_file('config/database.yml')['local']
        system("mysqldump --add-drop-table -h #{database['host']} -u #{database['username']} -p#{database['password']} #{database['database']} > /tmp/#{application}.sql")
        puts "Uploading local backup..."
        upload "/tmp/#{application}.sql", "#{backup_file}"
        puts "Removing local backup..."
        system("rm /tmp/#{application}.sql")
        puts "Importing into remote database..."
        database = YAML::load_file('config/database.yml')[stage.to_s]
        run "mysql -h #{database['host']} -u #{database['username']} -p#{database['password']} #{database['database']} < #{backup_file}"
        puts "Removing remote backup..."
        run "rm #{backup_file}"

    end
end



