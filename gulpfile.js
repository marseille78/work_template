var gulp = require('gulp');
var sass = require('gulp-sass');
var plumber = require('gulp-plumber');
// var autoprefixer = require('gulp-autoprefixer');
var gulpif = require('gulp-if');

var paths = {
    devDir: 'dev/',
    imgDir: 'dev/img/',
    cssDir: 'dev/css/'
};

var has = {};

// Проверки
// gulp-sass
function hasSass() {
    try { has.sass = !!sass; }
    catch(e) { has.sass = false; }
    return has.sass;
}
// gulp-autoprefixer
// var hasAutoprefixer = function() {
//     console.log('ggg');
//     try { has.autoprefixer = !!autoprefixer; }
//     catch(e) { has.autoprefixer = false; }
//     return has.autoprefixer;
// };
var hasAutoprefixer = function() {
    return false;
};

var libsCSS = [];
var libsJS = [];

// Работа с SCSS
if (hasSass()) {
    gulp.task('sass', function() {
        console.log('pref: ' + has.autoprefixer);
        gulp.src(paths.cssDir + 'sass/**/*.scss')
			.pipe(plumber())
            .pipe(sass({
                outputStyle: 'expanded'
            }))
			.pipe(gulpif(hasAutoprefixer, autoprefixer({browsers: ['last 15 versions'], cascade: false})))
            // .pipe(autoprefixer({browsers: ['last 15 versions'], cascade: false}))
            .pipe(gulp.dest(paths.cssDir));
    });
}
