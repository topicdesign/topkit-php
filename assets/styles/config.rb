# Require any additional compass plugins here.

# Set this to the root of your project:
http_path = (environment == :production) ? "/" : "/top/topkit/"
sass_dir = "sass"
css_dir = "."

images_dir = "assets/images"
javascripts_dir = "assets/scripts"
fonts_dir = "assets/fonts"

# You can select your preferred output style here (can be overridden via the command line):
output_style = (environment == :production) ? :compressed : :expanded

# To disable debugging comments that display the original location of your selectors. Uncomment:
line_comments = (environment == :production) ? false : true

# To enable relative paths to assets via compass helper functions. Uncomment:
# relative_assets = true
