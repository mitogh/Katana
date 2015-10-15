'use strict';
/******************************************************************************
| >   PLUGINS
******************************************************************************/
var gulp = require('gulp');
var phpcs = require('gulp-phpcs');
/******************************************************************************
| >   PROJECT VARIABLES
******************************************************************************/
var phpFiles = [
  '*.php',
];
/******************************************************************************
| >   PHP TASKS
******************************************************************************/
var phpOptions = {
  bin: './vendor/bin/phpcs',
  standard: './codesniffer.ruleset.xml',
  colors: true,
};
// Lint that does not break gulp
// Lint taks to inspect PHP files in order to follow WP Standards
 gulp.task('php:lint', function () {
 return gulp.src( phpFiles )
  .pipe(phpcs( phpOptions ))
  .pipe(phpcs.reporter('log'));
});
// Generate an error if there is a mistakte on PHP
gulp.task('php:ci', function () {
  return gulp.src( phpFiles )
  .pipe(phpcs( phpOptions ))
  .pipe(phpcs.reporter('log'))
  .pipe(phpcs.reporter('fail'));
});

/******************************************************************************
| >   WATCH TASKS
******************************************************************************/
gulp.task('watch', ['php:lint'], function(){
  gulp.watch( phpFiles, ['php:lint'] );
});

/******************************************************************************
| >   CONTINUOUS INTEGRATION TASK
******************************************************************************/
gulp.task('ci', ['php:ci']);

/******************************************************************************
| >   DEFAULT TASK
******************************************************************************/
gulp.task('default', ['watch']);

