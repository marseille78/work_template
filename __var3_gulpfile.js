var gulp         = require('gulp');
// var sass         = require('gulp-sass');
// // var autoprefixer = require('gulp-autoprefixer');
// var browserSync  = require('browser-sync').create(), host = 'test.dev';
// var concat       = require('gulp-concat');
// var cssnano       = require('gulp-cssnano');
// var uglify       = require('gulp-uglify');
// var spritesmith = require('gulp.spritesmith');
// var plumber = require('gulp-plumber');
//-----------------------------------
// var gulpif = require('gulp-if');
//
// var paths = {
// 	devDir: 'dev/',
// 	imgDir: 'dev/img/',
// 	sassDir: 'dev/css/sass/'
// };
//
// var libsCSS = [];
// var libsJS = [
// 	'dev/libs/jquery/dist/jquery.min.js',
// 	'dev/libs/bxslider/jquery.bxSlider.min.js'
// ];

// Локальный сервер с live-reload
// Для PHP
// gulp.task('browserSync', ['styles', 'scripts'], function() {
// 	browserSync.init({
// 		proxy: host,//используемый домен локального хостинга
// 		port: 3000,
// 		notify: false
// 	});
// });
var components = {
    // gulp:{task: null, fn: null, lib: 'gulp', watch: false},
    sass:{task: 'sass', vr: 'sass', fn: 'sass', lib: 'gulp-sass', watch: false}
}
for(var i in components){
    components[i].lib && (global[components[i].vr] = require(components[i].lib));
    // console.log(global[components[i].vr]);
    components[i].task && gulp.task(components[i].task, function () {
    	// console.log(23423423);
    	return global[components[i].fn+'Fn']();
    });
    components[i].warch && tasksBeforeWatch.push('sass');
}
// Работа с SCSS
// gulp.task('sass', function () {
	// return gulp.src('./dev/css/sass/**/*.scss')
	// 	.pipe(plumber())
	// 	.pipe(sass())
	// 	.pipe(autoprefixer({browsers: ['last 15 versions'], cascade: false}))
	// 	.pipe(gulp.dest('./dev/css'))
	// 	.pipe(browserSync.stream({stream: true}));
// });
global['sassFn'] = function() {
    return gulp.src('./dev/css/sass/**/*.scss')
        // .pipe(plumber())
        .pipe(global[components.sass.vr]())
        // .pipe(autoprefixer({browsers: ['last 15 versions'], cascade: false}))
        .pipe(gulp.dest('./dev/css'));
        // .pipe(browserSync.stream({stream: true}));
};
// // Подключение скриптов библиотек
// gulp.task('scripts', function() {
// 	return gulp.src(libsJS)
// 		.pipe(plumber())
// 		.pipe(concat('libs.min.js'))
// 		.pipe(uglify())
// 		.pipe(gulp.dest('./dev/js'))
// 		.pipe(browserSync.stream({stream: true}));
// });
//
// // Подключение стилей библиотек
// gulp.task('styles', function() {
// 	return gulp.src(libsCSS)
// 		.pipe(plumber())
// 		.pipe(concat('libs.min.css'))
// 		.pipe(cssnano())
// 		.pipe(gulp.dest('./dev/css'));
// });
//
// // SPRITES
// gulp.task('sprite', function() {
//     var spriteData = gulp.src(paths.imgDir + 'icons/*.png')
//         .pipe(spritesmith({
//             imgName: 'sprite.png',
//             cssName: '_sprite.scss',
// 			padding: 1
//         }));
//     spriteData.img.pipe(gulp.dest(paths.imgDir)); // Path to save image
//     spriteData.css.pipe(gulp.dest(paths.sassDir + 'other/')); // Path to save styles
// });
//
// // Прослушивание
// var tasksBeforeWatch = [];
//
// tasksBeforeWatch.push('browserSync');
// tasksBeforeWatch.push('sass');
// tasksBeforeWatch.push('scripts');
// tasksBeforeWatch.push('styles');

// gulp.task('watch', tasksBeforeWatch, function () {
// 	gulp.watch('./dev/css/**/*.scss', ['sass']);
// 	gulp.watch('./dev/**/*.html').on('change', browserSync.reload);
// 	gulp.watch('./dev/**/*.php').on('change', browserSync.reload);
// 	gulp.watch(['./dev/js/**/*.js', '!dev/js/libs.min.js'], browserSync.reload);
// });
// gulp.task('test',function(){
// 	return 'niko the best';
// });
// gulp.task('default', ['watch']);
// gulp.task('default',['test']);