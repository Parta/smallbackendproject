const gulp = require('gulp');
const { reload } = require('browser-sync');
const autoprefixer = require('gulp-autoprefixer');
const gulpif = require('gulp-if');
const minify = require('gulp-clean-css');
const notify = require('gulp-notify');
const path = require('path');
const plumber = require('gulp-plumber');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');

const config = require('./config');
const mode = require('./lib/mode');

gulp.task('css', () =>
  gulp
    .src(path.join(config.root.src, config.css.dev, 'main.scss'))
    .pipe(gulpif(!mode.production, sourcemaps.init()))
    .pipe(plumber({ errorHandler: notify.onError('Error: <%= error.message %>') }))
    .pipe(sass({
      includePaths: ['./node_modules', './bower_components'],
      outputStyle: 'expanded',
      sourceMap: true,
      errLogToConsole: true,
    }))
    .pipe(autoprefixer({
      browsers: ['last 3 version'],
    }))
    .pipe(gulpif(
      mode.production,
      minify({
        keepSpecialComments: 0,
      }),
    ))
    .pipe(gulpif(!mode.production, sourcemaps.write()))
    .pipe(gulp.dest(path.join(config.root.dist, config.css.dist)))
    .pipe(reload({ stream: true })));
