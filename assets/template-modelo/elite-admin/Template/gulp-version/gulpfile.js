var gulp = require('gulp'), // main
    sass = require('gulp-sass'), // scss compiler
    concat = require('gulp-concat'), // merge two files
    uglify = require('gulp-uglify'), // minify js files
    rename = require('gulp-rename'), // rename files
    cssmin = require('gulp-cssmin'), // minify css files
    merge = require('merge-stream'), // mearge two task
    gulpSequence = require('gulp-sequence'), //  execute multiple task
    babel = require("gulp-babel"), // convert next generation JavaScript, today.
    smushit = require('gulp-smushit'), // image optimizer
    autoprefixer = require('gulp-autoprefixer'), // css propertys autoprefixer
    cssbeautify = require('gulp-cssbeautify'), // css cssbeautify
    fileinclude = require('gulp-file-include'), // include html files
    htmlmin = require('gulp-htmlmin'); // html minify

const layout = {
    'layouts': 'vertical', // vertical / horizontal / combine
    'sublayouts': '',
    'darktheme': 'false', // true / false
    'rtltheme': 'false', // true / false  ( only for vertical layout )
    'bodyclass': '',
    'menuclass': 'menupos-fixed',
    'headerclass': 'headerpos-fixed',
}
//  [ scss compiler ] start
gulp.task('sass', function() {
    // main style css
    var maincss = gulp.src('src/assets/scss/*.scss')
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(cssbeautify())
        .pipe(gulp.dest('dist/assets/css'))

    // layout style css
    var layoutcss = gulp.src('src/assets/scss/partials/layouts/*.scss')
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(cssbeautify())
        .pipe(gulp.dest('dist/assets/css/layouts'))

    // Extra pages style css
    var pagescss = gulp.src('src/assets/scss/partials/pages/*.scss')
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(cssbeautify())
        .pipe(gulp.dest('dist/assets/css/pages'))

    return merge(maincss, layoutcss, pagescss);
})
//  [ scss compiler ] end

//  [ Copy assets ] start
gulp.task('build', function() {
    var cpyassets = gulp.src(['src/assets/**/*.*', '!src/assets/scss/**/*.*'])
        .pipe(gulp.dest('dist/assets'));
    var cpyextpage = gulp.src('src/html/extra-pages/**/*.*')
        .pipe(gulp.dest('dist/default/extra-pages'));
    var cpydoc = gulp.src('src/doc/*.*')
        .pipe(gulp.dest('dist/doc'));
    return merge(cpyassets, cpyextpage, cpydoc);
});
//  [ Copy assets ] end

//  [ build html ] start
gulp.task('build-html', function() {
    return gulp.src('src/html/*.html')
        .pipe(fileinclude({
            context: layout,
            prefix: '@@',
            basepath: '@file',
            indent: true
        }))
        .pipe(gulp.dest('dist/default'))
})
//  [ build html ] end

//  [ build js ] start
gulp.task('build-js', function() {
    var layoutjs = gulp.src('src/assets/js/*.js')
        .pipe(gulp.dest('dist/assets/js'))

    var pagesjs = gulp.src('src/assets/js/pages/*.js')
        .pipe(gulp.dest('dist/assets/js/pages'))

    return merge(layoutjs, pagesjs);
})
//  [ build js ] end

//  [ scss compiler ] start
gulp.task('mincss', function() {
    // main style css
    var maincss = gulp.src('src/assets/scss/*.scss')
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(cssbeautify())
        .pipe(gulp.dest('dist/assets/css'))
        .pipe(cssmin())
        .pipe(gulp.dest('dist/assets/css'))

    // layout style css
    var layoutcss = gulp.src('src/assets/scss/partials/layouts/*.scss')
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(cssbeautify())
        .pipe(gulp.dest('dist/assets/css/layouts'))
        .pipe(cssmin())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('dist/assets/css/layouts'))

    // Extra pages style css
    var pagescss = gulp.src('src/assets/scss/partials/pages/*.scss')
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(cssbeautify())
        .pipe(gulp.dest('dist/assets/css/pages'))
        .pipe(cssmin())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('dist/assets/css/pages'))
    return merge(maincss, layoutcss, pagescss);
})
//  [ scss compiler ] end

//  [ uglify js ] start
gulp.task('uglify', function() {
    var layoutjs = gulp.src('src/assets/js/*.js')
        .pipe(uglify())
        .pipe(gulp.dest('dist/assets/js'))

    var pagesjs = gulp.src('src/assets/js/pages/*.js')
        .pipe(babel())
        .pipe(uglify())
        .pipe(gulp.dest('dist/assets/js/pages'))

    return merge(layoutjs, pagesjs);
})
//  [ uglify js ] end

//  [ minify html ] start
gulp.task('htmlmin', function() {
    return gulp.src('src/html/*.html')
        .pipe(fileinclude({
            context: layout,
            prefix: '@@',
            basepath: '@file',
            indent: true
        }))
        .pipe(htmlmin({
            collapseWhitespace: true
        }))
        .pipe(gulp.dest('dist/default'))
})
//  [ minify html ] end

//  [ image optimizer ] start
gulp.task('imgmin', function() {
    return gulp.src('src/assets/img/**/*.{jpg,png}')
        .pipe(smushit())
        .pipe(gulp.dest('dist/assets/img'));
});
//  [ image optimizer ] end

//  [ Default task ] start
gulp.task(
    'default',
    gulp.series(
        'build',
        'sass',
        'build-js',
        'build-html',
        'imgmin'
    )
)
//  [ Default task ] end

//  [ watch ] start
gulp.task('watch', function() {
    gulp.watch('src/assets/scss/**/*.scss', gulp.series('sass'));
    gulp.watch('src/assets/js/**/*.js', gulp.series('build-js'));
    gulp.watch('src/html/**/*.html', gulp.series('build-html'));
    gulp.watch('src/doc/**/*.html', gulp.series('build'));
})
//  [ watch ] start

//  [ watch minify ] start
gulp.task('watch-minify', function() {
    gulp.watch('src/assets/scss/**/*.scss', gulp.series('mincss'));
    gulp.watch('src/assets/js/**/*.js', gulp.series('uglify'));
    gulp.watch('src/html/**/*.html', gulp.series('htmlmin'));
    gulp.watch('src/doc/**/*.html', gulp.series('build'));
})
//  [ watch minify ] start
