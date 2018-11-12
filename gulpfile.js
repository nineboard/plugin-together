var gulp = require('gulp')
var $ = require('gulp-load-plugins')()
var autoprefixer = require('gulp-autoprefixer')

var config = {
  isProduction: !!$.util.env.production,
  useSourceMaps: !$.util.env.production
}

gulp.task('default', ['sass'])

gulp.task('sass', function () {
  return gulp.src(['./assets/scss/*.scss', '!_*.scss'])
    .pipe($.if(config.useSourceMaps, $.sourcemaps.init()))
    .pipe($.plumber())
    .pipe($.sass({outputStyle: 'compressed'}).on('error', $.sass.logError))
    .pipe(autoprefixer({
      browsers: [
        'last 2 versions'
      ],
      cascade: false
    }))
    .pipe($.if(config.useSourceMaps, $.sourcemaps.write('.')))
    .pipe(gulp.dest('./assets/css'))
})

gulp.task('watch', function () {
  gulp.watch('./assets/scss/*.scss', ['sass'])
})
