############################################
# Setup Server
############################################

set :application, "achilles.repair" # typically the same as the domain
server "#{host}", :app

############################################
# Setup Git
############################################

set :branch, "master"