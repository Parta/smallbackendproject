const gulp = require('gulp');
const { reload } = require('browser-sync');
const path = require('path');

const config = require('./config');

gulp.task('static', () =>
  gulp
    .src(path.join(config.root.src, '*.{html,png,ico}'))
    .pipe(gulp.dest(path.join(config.root.dist)))
    .pipe(reload({ stream: true }))
);
