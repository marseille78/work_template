/**
 * Только сборка спрайтов.
 *
 * Запуск:
 * gulp sprite
 *
 * @type {*|Gulp}
 */
var gulp         = require('gulp');
var spritesmith = require('gulp.spritesmith');

var paths = {
    imgDir: 'dev/img/',
    sassDir: 'dev/css/sass/'
};

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