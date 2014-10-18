############################################
# Setup Server
############################################

set :application, "dev.achilles.repair" # typically the same as the domain
server "#{host}", :app

############################################
# Setup Git
############################################

set :branch, "development"