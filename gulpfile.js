var gulp = require('gulp'),
    pkg = require('./package.json'),
    webpack = require('webpack'),
    postcss = require('gulp-postcss'),
    rgba = require('postcss-hexrgba'),
    autoprefixer = require('autoprefixer'),
    cssvars = require('postcss-simple-vars'),
    nested = require('postcss-nested'),
    cssImport = require('postcss-import'),
    mixins = require('postcss-mixins'),
    colorFunctions = require('postcss-color-function'),
    cleanCSS = require('gulp-clean-css'),
    imageMin = require('gulp-imagemin'),
    webP = require('gulp-webp'),
    header = require('gulp-header'),
    zip = require('gulp-zip'),
    cssBanner = [
        '/*!',
        'Theme Name: <%= pkg.name %>',
        'Theme URI: <%= pkg.repository.url %>',
        'Author: <%= pkg.author.name %>',
        'Author URI: <%= pkg.author.url %>',
        'Description: <%= pkg.description %>',
        'Version: <%= pkg.version %>',
        'License: <%= pkg.license %>',
        '*/',
        ''
    ].join('\n'),
    phpBanner = [
        '<?php',
        '/**',
        ' * <%= pkg.name %>',
        ' * <%= pkg.description %>',
        ' * ',
        ' * @author <%= pkg.author.name %>',
        ' * @version v<%= pkg.version %>',
        ' * @link <%= pkg.repository.url %>',
        ' * @license <%= pkg.license %>',
        '*/',
        '?>',
        ''
    ].join('\n'),
    readmeBanner = [
        '=== <%= pkg.name %> ===',
        'Contributors: <%= pkg.author.name %>',
        'License: <%= pkg.license %>',
        '',
        '<%= pkg.description %>',
        '',
        ''
    ].join('\n');

gulp.task('styles', function() {
    return gulp.src('./css/style.css')
        .pipe(postcss([cssImport, mixins, cssvars, nested, rgba, colorFunctions, autoprefixer]))
        .on('error', (error) => console.log(error.toString()))
        .pipe(cleanCSS({ compatibility: '*' }))
        .pipe(header(cssBanner, { pkg: pkg }))
        .pipe(gulp.dest('./'));
});

gulp.task('scripts', function(callback) {
    webpack(require('./webpack.config.js'), function(err, stats) {
        if (err) {
            console.log(err.toString());
        }

        console.log(stats.toString());
        callback();
    });
});

gulp.task('png', function() {
    return gulp.src('./img/**/*.png')
        .pipe(imageMin([
            imageMin.optipng({ optimizationLevel: 5 })
        ]))
        .pipe(gulp.dest('./dist/img'));
});

gulp.task('jpg', function() {
    return gulp.src('./img/**/*.jpg')
        .pipe(imageMin([
            imageMin.mozjpeg({ quality: 80, progressive: true })
        ]))
        .pipe(gulp.dest('./dist/img'));
});

gulp.task('webp', function() {
    return gulp.src('./dist/img/*.{png,jpg}')
        .pipe(webP({ quality: 90 }))
        .pipe(gulp.dest('./dist/img'));
});

gulp.task('waitForStyles', gulp.series('styles', function() {
    return gulp.src('./style.css');
}));

gulp.task('waitForScripts', gulp.series('scripts', function(cb) {
    cb();
}));

gulp.task('buildStyles', function() {
    return gulp.src('./style.css')
        .pipe(gulp.dest('./dist'));
});

gulp.task('buildScripts', function() {
    return gulp.src('./js/scripts-bundled.js')
        .pipe(gulp.dest('./dist/js'));
});

gulp.task('buildImages', function() {
    return gulp.src('./img/**/*webp')
        .pipe(gulp.dest('./dist/img'));
});

gulp.task('php', function() {
    return gulp.src(['./**/*.php', '!./dist/**/*.*'])
        .pipe(header(phpBanner, { pkg: pkg }))
        .pipe(gulp.dest('./dist'));
});

gulp.task('readme', function() {
    return gulp.src('./readme.txt')
        .pipe(header(readmeBanner, { pkg: pkg }))
        .pipe(gulp.dest('./dist'));
});

gulp.task('zip', function() {
    return gulp.src('./dist/**/*')
        .pipe(zip('blank-theme.zip'))
        .pipe(gulp.dest('./deploy'))
});

gulp.task('watch', function() {
    gulp.watch('./css/**/*.css', gulp.parallel('waitForStyles'));
    gulp.watch(['./js/modules/*.js', './js/scripts.js'], gulp.parallel('waitForScripts'));
});

gulp.task('build', gulp.series(['buildStyles', 'buildScripts', 'png', 'jpg', 'webp', 'php', 'readme', 'zip']));