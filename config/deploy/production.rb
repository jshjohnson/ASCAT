############################################
# Setup Server
############################################

set :user, "joshuajohnson.co.uk"
set :host, "s156312.gridserver.com"
server "#{host}", :app
set :deploy_to, "/home/156312/users/.home/domains/anklearthritis.co.uk"

############################################
# Setup Git
############################################

set :branch, "master"