var gulp     = require('gulp'),
    codecept = require('gulp-codeception'),
    notify   = require('gulp-notify');

module.exports = {
    addTasks: function (options) {

        var bin;

        options = options || {};
        bin = options.bin || undefined;
        options.notify = (undefined !== options.notify) ? options.notify : true;

        /**
         * Task: 'codecept'
         */
        gulp.task('codecept', function () {
            gulp.src('./tests/**/*.php').pipe(codecept(bin, options))
                .on('error', notify.onError({
                    title  : "Testing Failed",
                    message: "Error(s) occurred during Codeception test..."
                }));
        });

        /**
         * Task: 'codecept:watch'
         */
        gulp.task('codecept:watch', ['codecept'], function () {
            gulp.watch(['./tests/**/*.php', './src/**/*.php'], ['codecept']);
        });
    }
};