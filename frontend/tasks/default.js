const gulp = require('gulp');
const runSequence = require('run-sequence');
const mode = require('./lib/mode');

const assets = ['img', 'fonts', 'static'];

gulp.task('default', (cb) => {
  mode.production
    ? runSequence('clean', assets, ['css', 'js'], cb)
    : runSequence(assets, 'css', 'watch', cb);
});
