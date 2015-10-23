var gulp         = require('gulp'),
    codecept     = require('gulp-codeception'),
    phpspecTasks = require('gulp-cm-phpspec-tasks');

var namespace = 'CubicMushroom\\Tools\\ProjectToolbelt\\';

// -----------------------------------------------------------------------------------------------------------------
// PHPSpec tasks
// -----------------------------------------------------------------------------------------------------------------

phpspecTasks.addTasks(gulp, namespace);


// -----------------------------------------------------------------------------------------------------------------
// Codecetion tasks
// -----------------------------------------------------------------------------------------------------------------

gulp.task('codecept', function() {
    gulp.src('./tests/**/*.php').pipe(codecept());
});

gulp.task('codecept:watch', function() {
    gulp.watch(['./tests/**/*.php', './src/**/*.php'], ['codecept']);
});