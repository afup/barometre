load 'deploy' if respond_to?(:namespace) # cap2 differentiator

require 'capifony_symfony2'

set :stages, %w(preprod prod)
set :default_stage, "preprod"
set :stage_dir, "app/config"
require 'capistrano/ext/multistage'