const gulp = require('gulp');
const watch = require('gulp-watch');
const path = require('path');

const config = require('./config');

gulp.task('watch', ['liveReload'], () => {
  const folders = ['css', 'img', 'static', 'fonts', 'js'];

  folders.forEach((task) => {
    watch(path.resolve(config.root.src, config[task].dev), () => {
      gulp.start(task);
    });
  });
});
