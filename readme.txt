 
=== JBTheme ===
Contributors: JBProvider
Requires at least: 5.0
Tested up to: 5.8
Requires PHP: 7.0
Stable tag: 1.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

== Description ==

JBTheme is a very simple theme for your business

== Installation ==

1. In your admin panel, go to Appearance -> Themes and click the 'Add New' button.
2. Type in JBTheme in the search form and press the 'Enter' key on your keyboard.
3. Click on the 'Activate' button to use your new theme right away.
4. Go to INSERT ABOUT PAGE for a guide on how to customize this theme.
5. Navigate to Appearance > Customize in your admin panel and customize to your taste.

== Copyright ==

JBTheme is a WordPress Theme, 2021-2022 jbprovider.com


== Cleanup code before deploying ==
cp -avr ./jbtheme ./final
find ./final/jbtheme -name "*.asset.php" -type f -delete
find ./final/jbtheme -name "*.js.map" -type f -delete
rm -rf ./final/jbtheme/node_modules
rm -rf ./final/jbtheme/src
rm -rf ./final/jbtheme/package.js
rm -rf ./final/jbtheme/package-lock.js
rm -rf ./final/jbtheme/webpack.config.js
rm -rf ./final/jbtheme/assets/css/components
rm -rf ./final/jbtheme/assets/css/default.css
rm -rf ./final/jbtheme/assets/css/footer.css 
rm -rf ./final/jbtheme/assets/css/global.css 
rm -rf ./final/jbtheme/assets/css/header.css 
rm -rf ./final/jbtheme/assets/css/main.min.css 
rm -rf ./final/jbtheme/assets/css/responsive.css 
rm -rf ./final/jbtheme/assets/css/variables.css 