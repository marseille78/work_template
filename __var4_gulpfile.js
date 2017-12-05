var gulp = require('gulp');

// Работа с SCSS
global['sassFn'] = function() {
    return gulp.src(paths.cssDir + '/sass/**/*.scss')
        .pipe(global[components.sass.vr]())
        .pipe(gulp.dest(paths.cssDir));
};

var components = {
    sass :{task: 'sass', vr: 'sass', fn: 'sassFn', lib: 'gulp-sass', watch: false},
    plumber :{task: null, vr: 'plumber', fn: null, lib: 'gulp-plumber', watch: false},
	autoprefixer: {task: null, vr: 'autoprefixer', fn: null, lib: 'gulp-autoprefixer', watch: false}
};

for (var i in components) {
    components[i].lib && (global[components[i].vr] = require(components[i].lib));
}

for (var i in components) {
    console.log(components[i].vr + ' - start');
	if (components[i].task) {
        console.log(components[i].vr + ' - in_progress');
        gulp.task(components[i].task, function() {
            return global[components[i].fn]();
        });
	}
}

// for(var i in components){
//     console.log(components[i]);
//     components[i].lib && (global[components[i].vr] = require(components[i].lib));
//     components[i].task && gulp.task(components[i].task, function () {
//         console.log(components[i]);
//     	return global[components[i].fn]();
//     });
// }

var paths = {
	cssDir: 'dev/css/'
};