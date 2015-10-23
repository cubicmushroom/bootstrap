var gulp          = require('gulp'),
    codeceptTasks = require('./gulp/gulp-cm-codeception-tasks'),
    phpspecTasks  = require('gulp-cm-phpspec-tasks');


var namespace = 'CubicMushroom\\Tools\\ProjectToolbelt\\';

// -----------------------------------------------------------------------------------------------------------------
// PHPSpec tasks
// -----------------------------------------------------------------------------------------------------------------

phpspecTasks.addTasks(gulp, namespace);


// -----------------------------------------------------------------------------------------------------------------
// Codecetion tasks
// -----------------------------------------------------------------------------------------------------------------

codeceptTasks.addTasks();