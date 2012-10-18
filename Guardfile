guard 'compass',
  configuration_file: './assets/styles/config.rb',
  project_path: './assets/styles' do
    watch(%r{(.*)\.s[ac]ss$})
end

require 'coffee_script'
guard 'sprockets',
  minify: false,
  asset_paths: ['application/assets/javascripts',
                'application/third_party/assets/javascripts'],
  destination: "public/javascripts" do
  watch (%r{^application/.*/javascripts/.*\.js.*}) do |m|
    ["application/assets/javascripts/public.js.coffee",
     "application/assets/javascripts/admin.js.coffee"]
  end
end
