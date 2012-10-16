guard 'coffeescript', :input => 'assets/scripts/coffee', :output => 'assets/scripts'

guard 'compass', :configuration_file => './assets/styles/config.rb', :project_path => './assets/styles' do
    watch(%r{(.*)\.s[ac]ss$})
end

guard 'jammit', :config_path => './assets/scripts/config.yml', :output_folder => './assets/scripts' do
  watch(%r{^assets/scripts/(.*)\.js$})
end
