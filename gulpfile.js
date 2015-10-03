var gulp = require('gulp');
var gulpif = require('gulp-if');
var uglify = require('gulp-uglify');
var uglifycss = require('gulp-uglifycss');
var less = require('gulp-less');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var livereload = require('gulp-livereload');
var mainBowerFiles = require('main-bower-files');
var env = process.env.GULP_ENV;

//JAVASCRIPT TASK: write one minified js file out of jquery.js, bootstrap.js and all of my custom js files
gulp.task('js', function () {
    var vendorsFiles = mainBowerFiles({filter: /.*\.js$/});
    var appFiles = [
        'app/Resources/public/js/**/*.js',
        'src/**/public/js/**/*.js'
    ];
    var files = vendorsFiles.concat(appFiles);

    return gulp.src(files)
        .pipe(concat('javascript.js'))
        .pipe(gulpif(env === 'prod', uglify()))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/js'));
});

//CSS TASK: write one minified css file out of bootstrap.less and all of my custom less files
gulp.task('css', function () {
    var vendorsFiles = mainBowerFiles({filter: /.*\.css$|.*\.less$/});
    var appFiles = [
        'app/Resources/public/less/**/*.less',
        'src/**/public/less/**/*.less'
    ];
    var files = vendorsFiles.concat(appFiles);

    return gulp.src(files)
        .pipe(gulpif(/[.]less/, less()))
        .pipe(concat('styles.css'))
        .pipe(gulpif(env === 'prod', uglifycss()))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/css'));
});

//IMAGE TASK: Just pipe images from project folder to public web folder
gulp.task('img', function () {
    return gulp.src('app/Resources/public/images/**/*.*')
        .pipe(gulp.dest('web/images'));
});

gulp.task('fonts', function () {
    var vendorsFiles = mainBowerFiles({filter: /.*\.otf$|.*\.eot$|.*\.svg$|.*\.ttf$|.*\.woff$|.*\.woff2$/})
    var extraFiles = [
        'bower_components/bootstrap/fonts/**'
    ];
    var files = vendorsFiles.concat(extraFiles);
    return gulp.src(files)
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/fonts'));
});

gulp.task('watch', function () {
    livereload.listen();
    gulp.watch('src/AppBundle/Resources/public/less/*.less', ['less']);

    return gulp.watch('src/AppBundle/Resources/public/coffee/*.coffee', ['coffee']);
});

//define executable tasks when running "gulp" command
gulp.task('default', ['js', 'css', 'fonts', 'img', 'watch']);
gulp.task('build', ['js', 'css', 'fonts', 'img']);
