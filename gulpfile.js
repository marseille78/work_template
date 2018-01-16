var gulp         = require('gulp');
var sass         = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var browserSync  = require('browser-sync').create(), host = 'work.dev';
var concat       = require('gulp-concat');
var cssnano       = require('gulp-cssnano');
var uglify       = require('gulp-uglify');
var svgstore = require('gulp-svgstore');
var svgmin = require('gulp-svgmin');
var spritesmith = require('gulp.spritesmith');//+
var plumber = require('gulp-plumber');

var paths = {
	devDir: 'dev/',
	imgDir: 'dev/img/',
	sassDir: 'dev/css/sass/'
};

var libsCSS = [];
var libsJS = [];

// Локальный сервер с live-reload
// Для PHP
gulp.task('browserSync', ['styles', 'scripts'], function() {
	browserSync.init({
		proxy: host,//используемый домен локального хостинга
		port: 3000
	});
});

// Работа с SCSS
gulp.task('sass', function () {
	return gulp.src('./dev/css/sass/**/*.scss')
		.pipe(plumber())
		.pipe(sass({
			outputStyle: 'expanded'
		}))
		.pipe(autoprefixer({browsers: ['last 15 versions'], cascade: false}))
		.pipe(gulp.dest('./dev/css'))
		.pipe(browserSync.stream({stream: true}));
});

// Подключение скриптов библиотек
gulp.task('scripts', function() {
	return gulp.src(libsJS)
		.pipe(plumber())
		.pipe(concat('libs.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('./dev/js'))
		.pipe(browserSync.reload({stream: true}));
});

// Подключение стилей библиотек
gulp.task('styles', function() {
	return gulp.src(libsCSS)
		.pipe(plumber())
		.pipe(concat('libs.min.css'))
		.pipe(cssnano())
		.pipe(gulp.dest('./dev/css'));
});

// SPRITES
gulp.task('sprite', function() {
    var spriteData = gulp.src(paths.imgDir + 'icons/*.png')
        .pipe(spritesmith({
            imgName: 'sprite.png',
            cssName: '_sprite.scss',
			padding: 1
        }));
    spriteData.img.pipe(gulp.dest(paths.imgDir)); // Path to save image
    spriteData.css.pipe(gulp.dest(paths.sassDir + 'other/')); // Path to save styles
});

// SVG-Sprites (Создание SVG-спрайтов)
// Собирает svg-спрайт, разделяя отдельные элементы по тегам <symbol> с идентификаторами, соответствующими названиям
// svg-файлов. Вызываются при помощи тега <use>
gulp.task('symbols', function() {
    return gulp.src(paths.img + 'svg/*.svg')
        .pipe(svgmin())
        .pipe(svgstore({
            inlineSvg: true// Вырезает из svg-файлов лишнюю информацию
        }))
        .pipe(rename('symbols.svg'))
        .pipe(gulp.dest(paths.devDir + 'img/'));
});

// Прослушивание
var tasksBeforeWatch = ['browserSync', 'sass', 'scripts', 'styles'];

gulp.task('watch', tasksBeforeWatch, function () {
	gulp.watch('./dev/css/**/*.scss', ['sass']);
	gulp.watch('./dev/**/*.html').on('change', browserSync.reload);
	gulp.watch('./dev/**/*.php').on('change', browserSync.reload);
	gulp.watch(['./dev/js/**/*.js', '!dev/js/libs.min.js'], browserSync.reload);
});

gulp.task('default', ['watch']);