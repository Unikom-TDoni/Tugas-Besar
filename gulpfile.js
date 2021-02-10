const {dest, src, series, watch, parallel}   =   require('gulp');
      gulpSass      =   require('gulp-sass');
      gulpPostcss   =   require('gulp-postcss');
      gulpRename    =   require('gulp-rename');
      autoprefixer  =   require('autoprefixer');
      browserSync   =   require('browser-sync').create();
      cssnano       =   require('cssnano');
      gulpUglify    =   require('gulp-uglify');

const files = {
    sassPath    : 'public/assets/pelanggan/sass/**/*.scss',
    jsPath      : 'public/assets/pelanggan/sass/**/*.scss',
    cssPath     : 'public/assets/pelanggan/css',
    miniJsPath  : 'public/dist/js',
    syncPath    : 'public/**/*.php',
    bootstrap   : {
        css     : 'node_modules/bootstrap/dist/css/bootstrap.min.css',
        js      : 'node_modules/bootstrap/dist/js/bootstrap.min.js',
        dest : 'public/assets/pelanggan/vendor/bootstrap'
    },
    awesome     : {
        css     : 'node_modules/font-awesome/css/font-awesome.min.css',
        font    : 'node_modules/font-awesome/fonts/*',
        destCss     : 'public/assets/pelanggan/vendor/fontawesome/css',
        destFont    : 'public/assets/pelanggan/vendor/fontawesome/fonts'
    }
}

function cssCompile(){
    return src(files.sassPath)
    .pipe(gulpSass().on('error', gulpSass.logError ))
    .pipe(gulpPostcss([autoprefixer(), cssnano()]))
    .pipe(gulpRename({suffix : '.min'}))
    .pipe(dest(files.cssPath))
    .pipe(browserSync.stream())
}

function jsCompile(){
    return src(files.jsPath)
        .pipe(gulpUglify())
        .pipe(gulpRename({suffix : '.min'}))
        .pipe(dest(files.miniJsPath))
        .pipe(browserSync.stream())
}

function vendorImport(){
    // import bootstrap
    src([files.bootstrap.css, files.bootstrap.js])
    .pipe(dest(files.bootstrap.dest))

    //import font awesome
    src(files.awesome.css)
    .pipe(dest(files.awesome.destCss))
    src(files.awesome.font)
    .pipe(dest(files.awesome.destFont))
}

function runCompile(){
    watch(files.sassPath, cssCompile);
    watch(files.jsPath, jsCompile);
    browserSync.init({
        proxy: "http://localhost/tugasakhirpbo/rentall/public/"
    })
    watch(files.syncPath).on('change', browserSync.reload);
}

exports.default = parallel(
    vendorImport,
    cssCompile,
    jsCompile,
    runCompile
)
