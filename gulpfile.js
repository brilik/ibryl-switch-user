const gulp = require('gulp'),
    sass = require('gulp-sass')(require('sass')),
    minifyCss = require('gulp-minify-css'),
    minify = require('gulp-minify'),
    rename = require('gulp-rename')

gulp.task('css', function () {
    return gulp.src('./assets/css/**/*.scss')
        .pipe(sass())
        .pipe(minifyCss({
            keepSpecialComments: 0,
        }))
        .pipe(rename({extname: '.min.css'}))
        .pipe(gulp.dest('./assets/css/'))
});

gulp.task('js', function () {
        return gulp.src('./assets/js/**/!(*.min)*.js')
        .pipe(minify({
            ext: {
                min: '.min.js',
            },
            noSource: true,
        }))
        .pipe(gulp.dest('./assets/js/'))
});

gulp.task('watch', function () {
    gulp.watch('./assets/css/**/*.scss', gulp.series(['css']))
    gulp.watch('./assets/js/**/!(*.min)*.js', gulp.series(['js']))
})