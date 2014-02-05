require 'capistrano-deploytags'
 
set :stages, %w(production staging)
set :default_stage, 'production'
 
require 'capistrano/ext/multistage'
 
#
#  After running cap deploy:cold, You'll need to remove all files from the
#  domains/yourdomain.com/html directory and turn the html directory into a
#  symlink that links to ./current which is also a symlink setup by capistrano.
#
 
# Configure these
set :site,         "156312" # this is your site number, https://kb.mediatemple.net/questions/268/What+is+my+site+number%3F#gs
set :application,  "anklearthritis.co.uk" # typically the same as the domain
 
# Shouldn't have to change anything below
set(:domain) { "s#{site}.gridserver.com" }
set(:user) { "serveradmin@#{application}" }
 
# Other options
default_run_options[:pty] = true
default_run_options[:shell] = false
set :use_sudo, false # MediaTemple doesn't allow sudo command
 
# Repo stuff
set :ssh_options, { :forward_agent => true }
set :scm, :git
#set :repository, "." # assumes you are running cap deploy while your current working directory is the repo
set :repository, "git@github.com:jshjohnson/TARVA.git"
# set :deploy_via, :copy
set :deploy_via, :remote_cache
set :copy_cache, true
set :copy_exclude, [".git", "bin/", "config/", "Capfile"]  # no need to include the git config directory
set(:branch) { "master" } # you can change this if you would like to use another branch
 
# Path stuff, make sure to symlink html to ./current
set(:deploy_to) { "/home/#{site}/users/.home/domains/#{application}" }
set(:current_deploy_dir) { "#{deploy_to}/current" }
# make sure you have added a tmp directory inside domains/example.com with correct permissions (i.e 755)
set(:copy_remote_dir) { "#{deploy_to}/tmp" }
set(:keep_releases) { 2 } # keep this low for larger sites, can be up to 5 if you are really nervous
 
# Roles
role :web, domain
role :app, domain
role :db,  domain, :primary => true
 
# we need a relative path for the current symlink, without this
# current is set to link to the release starting from the /home directory
# which has a directory that is not owned by the serveradmin and apache
# won't have access
def relative_path(from_str, to_str)
  require 'pathname'
  Pathname.new(to_str).relative_path_from(Pathname.new(from_str)).to_s
end
 
# overwrite the symlink method to use the relative path method above
namespace :deploy do
  desc "Relative symlinks for current, so we don't use full path"
  task :create_symlink, :except => { :no_release => true } do
    if releases[-2] # not the first release
      previous_release_relative = relative_path(deploy_to, previous_release + '/htdocs')
      on_rollback { run "rm -f #{current_path}; ln -s #{previous_release_relative} #{current_path}; true" }
    end
    latest_release_relative = relative_path(deploy_to, latest_release + '/htdocs')
    run "rm -f #{current_path} && ln -s #{latest_release_relative} #{current_path}"
  end
end
 
after "deploy:finalize_update" do
  redmonster.symlinks
  run "cp #{current_release}/htdocs/wp-config-#{stage}.php #{current_release}/htdocs/wp-config.php"
end
 
# My own application namespace for deploy tasks.
namespace :tarva do
    # Symlink shared path for image uploads so each release can reference image uploads.
    task :symlinks do
      shared_images = relative_path("#{release_path}/htdocs/wp-content", "#{shared_path}/uploads/")
      run "ln -nfs #{shared_images} #{release_path}/htdocs/wp-content/uploads"
    end
end