############################################
# Setup Server
############################################

set :application, "anklearthritis.co.uk" # typically the same as the domain
server "#{host}", :app

############################################
# Setup Git
############################################

set :branch, "master"