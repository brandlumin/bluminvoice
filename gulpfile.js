/* VARIABLES SETUP - plugins */
const { dest, gulp, parallel, series, src, lastRun, watch } = require("gulp"),
  babel = require("gulp-babel"),
  concat = require("gulp-concat"),
  htmlmin = require("gulp-htmlmin"),
  livereload = require("gulp-livereload"),
  postcss = require("gulp-postcss"),
  prefix = require("autoprefixer"),
  sass = require("gulp-sass"),
  sourcemaps = require("gulp-sourcemaps"),
  stripCSS = require("gulp-strip-css-comments"),
  terser = require("gulp-terser"),
  /* VARIABLES SETUP - plugins options */
  terserOptions = {
    output: {
      beautify: false, // true,
      comments: false, // default is FALSE
      // comments: "/^[!*]/", // default is FALSE
      indent_level: 2,
      ecma: 2016,
      quote_style: 0 // quote style: prefers double quotes
    },
    ecma: 2016,
    keep_fnames: true,
    mangle: true, // default
    toplevel: false,
    warnings: "verbose",
  }, // https://github.com/terser/terser#minify-options
  sassOptions = {
    errLogToConsole: true,
    precision: 10,
    sourceComments: false, // true,
    outputStyle: "compressed", // "compact",
  },
  htmlminOptions = {
    html5: true,
    ignoreCustomFragments: [/(<%.*%>)/, /<\?[=|php]?[\s\S]*?\?>/, /<\?[\s\S]*?\?>/],
    removeComments: true,
    includeAutoGeneratedTags: true,
    minifyCSS: true,
    minifyJS: true
  },
  postcssOptions = [prefix({ grid: true })],
  /* VARIABLES SETUP - files */
  bootstrapFiles = "source/scss/bootstrap/**/*",
  blStyleFiles = "source/scss/brandlumin/**/*",
  jsPluginFiles = [
    "source/js/jquery-3.5.1.min.js",
    "source/js/popper.min.js",
    "source/js/bootstrap.min.js",
  ],
  blScriptFiles = "source/js/bl*.js*",
  frontEndFiles = ["*.htm*", "*.php"];


/* FUNCTION DEFINITIONS */
function preloadJS() {
  return src(jsPluginFiles, { allowEmpty: true })
    .pipe(sourcemaps.init())
    .pipe(concat("preload.js", { newLine: ";" }))
    .pipe(sourcemaps.write('.'))
    .pipe(dest("site/scripts/"));
}

function workScript() {
  return src(blScriptFiles, { allowEmpty: true }) /*.pipe(sourcemaps.init())*/
    .pipe(sourcemaps.init())
    .pipe(concat("site.js"))
    // .pipe(sourcemaps.write())
    .pipe(terser(terserOptions))
    .pipe(
      concat("script6es.js", { newLine: ";" })
    )
    .pipe(sourcemaps.write('.'))
    .pipe(dest("site/scripts/"))
    .pipe(livereload());
}

function bootstrapCSS() {
  return src("source/scss/bootstrap/bootstrap.scss", { allowEmpty: true })
    .pipe(sourcemaps.init())
    .pipe(sass.sync(sassOptions).on("error", sass.logError))
    .pipe(postcss([prefix()]))
    .pipe(stripCSS())
    .pipe(sourcemaps.write('.'))
    .pipe(dest("site/styles/"))
    .pipe(livereload());
}

function workStyle() {
  return src("source/scss/brandlumin/bluminvoice.sass", { allowEmpty: true })
    .pipe(sourcemaps.init())
    .pipe(sass.sync(sassOptions).on("error", sass.logError))
    .pipe(postcss([prefix()])) /*.pipe(stripCSS())*/
    .pipe(sourcemaps.write('.'))
    .pipe(dest("site/styles/").on("finish", (callback) => livereload.reload()));
}

function workMinifyFrontEnd() {
  return src(frontEndFiles, { allowEmpty: true, since: lastRun(workMinifyFrontEnd) })
    .pipe(htmlmin(htmlminOptions))
    .pipe(dest("site/").on("finish", (callback) => livereload.reload()));
}

/* WATCH FUNCTION */
function watchFiles() {
  watch(bootstrapFiles, bootstrapCSS);
  watch(blStyleFiles, workStyle);
  watch(jsPluginFiles, preloadJS);
  watch(blScriptFiles, workScript);
  watch(frontEndFiles, workMinifyFrontEnd);
  console.log(">> Begun watching for changes...");
}

/* SERVER SETUP FUNCTION */
function setupServer() {
  livereload.listen(function () {
    console.log(">> The server has been established...");
    setTimeout(function () {
      console.log(">> ...let's begin development...");
    }, 600);
  });
}

/* FINAL EXPORTS */
exports.default = series(
  bootstrapCSS,
  preloadJS,
  workStyle,
  workScript,
  workMinifyFrontEnd,
  parallel(setupServer, watchFiles)
);
exports.styles = series(bootstrapCSS, workStyle);
exports.scripts = series(preloadJS, workScript);
exports.frontend = series(workMinifyFrontEnd);
exports.workMinifyfrontend = series(workMinifyFrontEnd);