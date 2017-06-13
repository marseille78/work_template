var gulp         = require('gulp'),
	sass         = require('gulp-sass'),
	autoprefixer = require('gulp-autoprefixer'),
	browserSync  = require('browser-sync').create(),
	concat       = require('gulp-concat'),
	cssnano       = require('gulp-cssnano'),
	uglify       = require('gulp-uglify');

// Локальный сервер с live-reload
// Для PHP
gulp.task('browserSync', ['styles', 'scripts'], function() {
	browserSync.init({
		proxy: 'test.dev',//используемый домен локального хостинга
		notify: false
	});
});

// Для HTML, Pug
// gulp.task('browser-sync', function() {
// 	browserSync({
// 		server: {
// 			baseDir: 'dev'
// 		},
// 		notify: false
// 	})
// });

// Работа с Pug
// gulp.task('pug', function() {
//     return gulp.src('dev/pug/pages/*.pug')
//         .pipe(plumber())
//         .pipe(pug({
//             pretty: true
//         }))
//         .on("error", notify.onError(function(error) {
//             return "Message to the notifier: " + error.message;
//         }))
//         .pipe(gulp.dest('dev'));
// });

// Работа с SCSS
gulp.task('sass', function () {
	return gulp.src('./dev/css/sass/**/*.scss')
		.pipe(sass())
		.pipe(autoprefixer({browsers: ['last 15 versions'], cascade: false}))
		.pipe(gulp.dest('./dev/css'))
		.pipe(browserSync.stream({stream: true}));
});

// Подключение скриптов библиотек
gulp.task('scripts', function() {
	return gulp.src([
			// Библиотеки
			// 'dev/libs/jquery/dist/jquery.min.js',
			// 'dev/libs/magnific-popup/dist/jquery.magnific-popup.min.js'
		])
		.pipe(concat('libs.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('./dev/js'))
        .pipe(browserSync.reload({
            stream: true
        }));
});

// Подключение стилей библиотек
gulp.task('styles', function() {
	return gulp.src([
			// Стили библиотек
			// 'dev/libs/magnific-popup/dist/magnific-popup.css'
		])
		.pipe(concat('libs.min.css'))
		.pipe(cssnano())
		.pipe(gulp.dest('./dev/css'));
});

// Прослушивание
gulp.task('watch', ['browserSync', 'sass', /*'pug',*/ 'scripts', 'styles'], function () {
	gulp.watch('./dev/css/**/*.scss', ['sass']);
	// gulp.watch('dev/pug/**/*.pug', ['pug']);
	gulp.watch('./dev/**/*.html').on('change', browserSync.reload);
	gulp.watch('./dev/**/*.php').on('change', browserSync.reload);
	gulp.watch(['./dev/js/**/*.js', '!dev/js/libs.min.js', '!dev/static/js/jquery.js'], browserSync.reload);
});

gulp.task('default', ['watch']);

/*

#####
# HTML, CSS, JS - процессоры
#####

gulp-pug - Для работы с pug
gulp-jade
gulp-slim

------------------------------

gulp-less
gulp-stylus
gulp-sass

------------------------------

gulp-coffee
gulp-babel

------------------------------

gulp-autoprefixer
gulp-sourcemaps

#####
# Работа с изображениями
#####

gulp-imagemin - сжатие изображений
gulp-spritesmith - создание спрайтов
gulp-base64 - конвертация в base64

#####
# Сборка
#####

gulp-useref - для переноса результатов в папку build
gulp-processhtml - для переноса результатов в папку build
gulp-flatter - помогает переносить в build bower-компоненты

#####
# Helpers
#####

--- Минификации ---
gulp-htmlmin
gulp-minify-css
gulp-uglify

--- Подсказки, ошибки и т.д. ---
gulp-htmlhint
gulp-csslint
gulp-jshint

browser-sync - релоадер для страницы
wiredep - автоматическое подключение bower-компонентов
gulp-concat - конкатенация файлов
gulp-replace-path
del
gulp-if
gulp-never
gulp-uncss - убирает неиспользуемые CSS-стили (осторожно)
gulp-plumber
gulp-notify
gulp-filter
gulp-rename
gulp-combine-media-queries
gulp-csscomb

*/