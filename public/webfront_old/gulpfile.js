// include gulp

require('es6-promise').polyfill();  // for css minification
var gulp = require('gulp'); 
var changed = require('gulp-changed');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var minify = require('gulp-minify');
var ngAnnotate = require('gulp-ng-annotate');

// New Minifier
var uglifyjs = require('uglify-js');
var minifier = require('gulp-uglify/minifier');
var pump = require('pump')

//css
var minifyCSS = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');

// include plug-ins
//var jshint = require('gulp-jshint');

// // JS hint task
// gulp.task('jshint', function() {
//   gulp.src('./app/controllers/*.js')
//     .pipe(jshint())
//     .pipe(jshint.reporter('default'));
// });

// // minify healthiansStylesheet1.css
// gulp.task('css', function(){
//  gulp.src('./assets/style/css/healthiansStylesheet1.css')
//    .pipe(concat('healthiansStylesheet.min.css'))
    
//      .pipe(minifyCSS())
      
//      //.pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
//      .pipe(gulp.dest('./assets/style/css/'));
// });

// // minify responsive.css
// gulp.task('css1', function(){
//   gulp.src('./assets/style/css/responsive.css')
//     .pipe(concat('responsive.min.css'))
    
//       .pipe(minifyCSS())
      
//       //.pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
//       .pipe(gulp.dest('./assets/style/css/'));
// });

// // minify custome.css
// gulp.task('css2', function(){
//   gulp.src('./assets/style/css/custome.css')
//     .pipe(concat('custome.min.css'))
    
//       .pipe(minifyCSS())
      
//       //.pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
//       .pipe(gulp.dest('./assets/style/css/'));
// });

//Controller concat and miniff
// gulp.task('scripts', function() {
//   gulp.src('./app/controllers/*.js')
//     .pipe(concat('controller.js'))
//     .pipe(ngAnnotate({add: true}))
//     .pipe(uglify())
//     .pipe(gulp.dest('./build/controller/'));
// });

/* Break Vendor js into 100kb files */
gulp.task('vendor1', function() {
  gulp.src(['./assets/js/jquery.min.js'])
    .pipe(concat('vendor1.js'))
    .pipe(ngAnnotate({add: true}))
    .pipe(uglify())
    .pipe(gulp.dest('./build/assets/'));
});

gulp.task('vendor2', function() {
  gulp.src(['./assets/js/waypoints.min.js','./assets/js/bootstrap.min.js','./assets/js/moment.min.js', './assets/js/scripts.js'])
    .pipe(concat('vendor11.js'))
    .pipe(ngAnnotate({add: true}))
    .pipe(uglify())
    .pipe(gulp.dest('./build/assets/'));
});

gulp.task('vendor3', function() {
  gulp.src(['./assets/js/bootstrap-datepicker.min.js','./assets/js/angular-ui-router.min.js'])
    .pipe(concat('vendor10.js'))
    .pipe(gulp.dest('./build/assets/'));
});

gulp.task('vendor4', function() {
  gulp.src(['./assets/script/ngStorage.min.js','./assets/script/input-token/ng-tags-input.js','./assets/js/angulartics.min.js','./assets/js/angular-lazy-img/release/angular-lazy-img.js','./assets/js/angulartics-ga.min.js','./assets/js/angular-facebook.js','./assets/js/angular-google-plus.js', './assets/js/underscore-min.js', './assets/js/slick.js','./assets/js/angular-socialshare.min.js','./assets/js/angular-base64-upload.js', './assets/js/angular-sanitize.js', './assets/js/rzslider.js'])
    .pipe(concat('v1.js'))
    .pipe(ngAnnotate({add: true}))
    .pipe(uglify())
    .pipe(gulp.dest('./build/assets/'));
});

/*Combine and minify all directives, services and factory */
/* This task run on both testing and production because it contains constant */
gulp.task('app', function() {
  gulp.src(['./app/app.module.js','./app/app.route.js','./app/directives/loader-directive.js','./app/directives/modal-directive.js','./app/factory/searchDetail.js','./app/services/service.js','./app/services/HomeService.js','./app/services/BookOrderService.js', './app/services/DashboardService.js'])
    .pipe(concat('app.js'))
    .pipe(ngAnnotate({add: true}))
    .pipe(uglify())
    .pipe(gulp.dest('./build/assets/'));
});

/* Break allcss into 100kb files */
gulp.task('css1', function(){
  gulp.src(['./assets/style/custom/style.css','./assets/style/css/slick.css'])
    .pipe(concat('vendor1.css'))
    .pipe(minifyCSS())
    .pipe(gulp.dest('./assets/style/css/'));
});

gulp.task('css2', function(){
  gulp.src(['./assets/style/css/healthiansStylesheet1.css'])
    .pipe(concat('vendor2.css'))
    .pipe(minifyCSS())
    .pipe(gulp.dest('./assets/style/css/'));
});

gulp.task('css3', function(){
  gulp.src(['./assets/style/css/custome.css','./assets/style/css/responsive.css'])
    .pipe(concat('vendor3.css'))
    .pipe(minifyCSS())
    .pipe(gulp.dest('./assets/style/css/'));
});

gulp.task('css4', function(){
  gulp.src(['./assets/style/custom/bootstrap.min.css','./assets/style/css/bootstrap-datepicker.min.css','./assets/style/input-token/ng-tags-input.css','./assets/style/input-token/ng-tags-input.bootstrap.css'])
    .pipe(concat('vendor6.css'))
    .pipe(minifyCSS())
    .pipe(gulp.dest('./assets/style/css/'));
});

//New Controller concat and miniff
// sudo npm install -g git+https://github.com/mishoo/UglifyJS2.git#harmony
var options = {
  preserveComments: 'license'
};

gulp.task('cont', function(cb) {
  pump([
    gulp.src('./app/controllers/*.js'),
      concat('controller.js'),
      minifier(options, uglifyjs),
      gulp.dest('./build/controller/')
      ], cb)
});

//https://www.npmjs.com/package/gulp-cdnizer
var cdnizer = require("gulp-cdnizer");

gulp.task('csscdn', function(){
  gulp.src(["./assets/style/css/custome.css","./assets/style/css/healthiansStylesheet1.css","./assets/style/css/responsive.css"])
    .pipe(cdnizer({
      defaultCDNBase: 'https://cdn4.healthians.com/',
      //relativeRoot: 'css',
      files: ['**/*.{gif,png,jpg,jpeg,eot,woff,woff2,otf,ttf,svg,svg#Gotham-Book,eot?#iefix,svg#GothamNarrow-Book,svg#slick,JPG,JPEG,PNG,GIF}']
    }))
    .pipe(gulp.dest("./build/assets/"));
});

gulp.task('concatcss2', function(){
  gulp.src(['./build/assets/healthiansStylesheet1.css'])
    .pipe(concat('vendor2.css'))
    .pipe(minifyCSS())
    .pipe(gulp.dest('./assets/style/css/'));
});

gulp.task('concatcss3', function(){
  gulp.src(['./build/assets/custome.css','./build/assets/responsive.css'])
    .pipe(concat('vendor3.css'))
    .pipe(minifyCSS())
    .pipe(gulp.dest('./assets/style/css/'));
});

gulp.task('dist_cdn', ['csscdn', 'concatcss2','concatcss3']);

gulp.task('dist_js', ['vendor1', 'vendor2', 'vendor3', 'vendor4', 'app' , 'cont']);