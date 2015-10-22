var gulp         = require('gulp'),
    phpspecTasks = require('gulp-cm-phpspec-tasks');

var namespace = 'CubicMushroom\\Tools\\ProjectToolbelt\\';

// -----------------------------------------------------------------------------------------------------------------
// PHPSpec tasks
// -----------------------------------------------------------------------------------------------------------------
phpspecTasks.addTasks(gulp, namespace);