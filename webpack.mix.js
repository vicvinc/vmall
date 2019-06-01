let mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .js("resources/assets/js/mall/index.js", "public/mall/js")
  .extract(["vue", "vuex", "vue-router", "axios", "mint-ui", "vant"])
  .sass("resources/assets/sass/mall.scss", "public/mall/css")
  .sass("resources/assets/sass/admin.scss", "public/admin/css")
  .options({
    postCss: [
      require("postcss-css-variables")(),
      require("autoprefixer")({
        browsers: ["> 1%", "last 2 versions"]
      })
    ]
  })
  .copy("resources/assets/css", "public/admin/css")
  .copy("resources/assets/js/admin", "public/admin/js")
  .copy("resources/assets/fonts", "public/admin/fonts")
  .copy("resources/assets/images", "public/mall/images")
  .copy("resources/assets/uploads", "public/mall/uploads");
