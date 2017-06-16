"use strict";

var gulp = require('gulp'),
	pug = require('gulp-pug'),
	sass = require('gulp-sass'),
	concat = require('gulp-concat'),
	plumber = require('gulp-plumber'),
	prefix = require('gulp-autoprefixer'),
	imagemin = require('gulp-imagemin'),
	browserSync = require('browser-sync').create();

var useref = require('gulp-useref'),
	gulpif = require('gulp-if'),
	cssmin = require('gulp-clean-css'),
	uglify = require('gulp-uglify'),
	rimraf = require('rimraf'),
	notify = require('gulp-notify'),
	ftp = require('vinyl-ftp');

var paths = {
			blocks: 'blocks/',
			devDir: 'app/',
			outputDir: 'build/'
		};


/*********************************
		Developer tasks
*********************************/

//pug compile
gulp.task('pug', function() {
	return gulp.src([paths.blocks + '*.pug', '!' + paths.blocks + 'template.pug' ])// Собирает все файлы .pug из папки /blocks/, кроме файла /blocks/template.pug
		.pipe(plumber())// чтобы при какой-ниибудь ошибке ничего не вылетало
		.pipe(pug({pretty: true}))// компилирует pug => html
		.pipe(gulp.dest(paths.devDir))// помещает результат в папку app/
		.pipe(browserSync.stream())// обновление локального сервера
});

//sass compile
gulp.task('sass', function() {
	return gulp.src(paths.blocks + '*.scss')// собирает все scss-файлы
		.pipe(plumber())
		.pipe(sass().on('error', sass.logError))
		.pipe(prefix({// простановка css-префиксов
			browsers: ['last 10 versions'],
			cascade: true
		}))
		.pipe(gulp.dest(paths.devDir + 'css/'))// помещает результат в папку app/css
		.pipe(browserSync.stream());
});

//js compile
gulp.task('scripts', function() {
	return gulp.src([
			paths.blocks + '**/*.js',// собираем все js-файлы в папке blocks/
			'!' + paths.blocks + '_assets/**/*.js'// кроме тех, что находятся в папке blocks/_assets (т.к. они будут отдельно подключаться и сжиматься)
		])
		.pipe(concat('main.js'))// Склеивается в один файл
		.pipe(gulp.dest(paths.devDir + 'js/'))// помещает результат в папку js/
		.pipe(browserSync.stream());
});

//watch
gulp.task('watch', function() {// прослушивание на счет изменений в файлах с указанными ниже путями и запуск соответствующей задачи
	gulp.watch(paths.blocks + '**/*.pug', ['pug']);
	gulp.watch(paths.blocks + '**/*.scss', ['sass']);
	gulp.watch(paths.blocks + '**/*.js', ['scripts']);
});

//server
gulp.task('browser-sync', function() {// установка локального сервера на порту 3000
	browserSync.init({
		port: 3000,
		server: {
			baseDir: paths.devDir// устанавливаем корневой папкой локального сервера директорию app/
		}
	});
});


/*********************************
		Production tasks
*********************************/

//clean
gulp.task('clean', function(cb) {// очищает production-директорию build/
	rimraf(paths.outputDir, cb);
});

//css + js
gulp.task('build', ['clean'], function () {// компиляция production-версии
	return gulp.src(paths.devDir + '*.html')// собирает все html-файлы в директории app/
		.pipe( useref() )// производит поиск файлов по соответствущим комментариям и объединяет их между собой (в комментариях также указано в какой файл переименовать результат и в какую директорию его поместить)
		.pipe( gulpif('*.js', uglify()) )// если находяться js-файлы, то они минифицируются
		.pipe( gulpif('*.css', cssmin()) )// если находятся css-файлы, то они минифицируются
		.pipe( gulp.dest(paths.outputDir) );// результат помещается в production-директорию build/
});

//copy images to outputDir
gulp.task('imgBuild', ['clean'], function() {
	return gulp.src(paths.devDir + 'img/**/*.*')
		.pipe(imagemin())
		.pipe(gulp.dest(paths.outputDir + 'img/'));
});

//copy fonts to outputDir
gulp.task('fontsBuild', ['clean'], function() {
	return gulp.src(paths.devDir + '/fonts/*')
		.pipe(gulp.dest(paths.outputDir + 'fonts/'));
});

//ftp
gulp.task('send', function() {
	var conn = ftp.create({
		host:     '',
		user:     '',
		password: '',
		parallel: 5
	});

	/* list all files you wish to ftp in the glob variable */
	var globs = [
		'build/**/*',
		'!node_modules/**' // if you wish to exclude directories, start the item with an !
	];

	return gulp.src( globs, { base: '.', buffer: false } )
		.pipe( conn.newer( '/' ) ) // only upload newer files
		.pipe( conn.dest( '/' ) )
		.pipe(notify("Dev site updated!"));

});


//default
gulp.task('default', ['browser-sync', 'watch', 'pug', 'sass', 'scripts']);

//production
gulp.task('prod', ['build', 'imgBuild', 'fontsBuild']);