# Require any additional compass plugins here.

# Set this to the root of your project:
http_path = (environment == :production) ? "/" : "/top/topkit/"
sass_dir = "."
additional_import_paths = [
  '../../third_party/assets/stylesheets'
]

css_dir = "../../../public/stylesheets"
http_stylesheets_path = (environment == :production) ? '/public/stylesheets/' : '/top/topkit/public/stylesheets/'

images_dir = "../../../public/images"
http_images_path = (environment == :production) ? '/public/images/' : '/top/topkit/public/images/'

javascripts_dir = "../../../public/javascripts"
http_javascripts_path = (environment == :production) ? '/public/javascripts/' : '/top/topkit/public/javascripts/'

fonts_dir = "../../../public/fonts"
http_fonts_path = (environment == :production) ? '/public/fonts/' : '/top/topkit/public/fonts/'

# You can select your preferred output style here (can be overridden via the command line):
output_style = (environment == :production) ? :compressed : :expanded

# To disable debugging comments that display the original location of your selectors. Uncomment:
line_comments = (environment == :production) ? false : true

# To enable relative paths to assets via compass helper functions. Uncomment:
relative_assets = false

