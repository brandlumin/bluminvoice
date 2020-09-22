/* VARIABLES SETUP - plugins */
const { dest, gulp, parallel, series, src, watch } = require("gulp"),
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
      beautify: false,
      comments: false,
      indent_level: 2,
      ecma: 2015,
      quote_style: 0,
    },
    ecma: 2015,
    keep_fnames: true,
    mangle: true,
    toplevel: false,
    warnings: "verbose",
  }, // https://github.com/terser/terser#minify-options
  babelOptions = {
    presets: [
      "@babel/preset-env",
      {
        sourceType: "module",
        compact: "auto" /*default*/,
        comments: false /*, minified: true*/,
      },
    ], // "sourceType": "unambiguous" to kill STRICT
    plugins: [["@babel/plugin-transform-arrow-functions", { spec: true }]],
  },
  sassOptions = {
    errLogToConsole: true,
    precision: 10,
    // sourceComments: true,
    outputStyle: "compact",
  },
  htmlminOptions = {
    collapseWhitespace: true,
    removeAttributeQuotes: true,
    removeComments: true,
    removeEmptyAttributes: true,
    ignoreCustomFragments: [/(<%.*%>)/, /(<\?php(.|\n)*(\?>)?)/],
  };
// postcssOptions = [ prefix({grid: true}) ];
/* VARIABLES SETUP - files */
const bootstrapFiles = "source/scss/bootstrap/**/*",
  cssPluginFiles = "source/scss/plugin/**/*",
  styleFiles = "source/scss/brandlumin/**/*",
  jsPluginFiles = [
    "source/js/jquery-3.5.1.min.js",
    "source/js/popper.min.js",
    "source/js/bootstrap.min.js",
  ],
  scriptFiles = "source/js/bl*.*",
  frontEndFiles = ["*.html", "*.php"];

/* FUNCTION DEFINITIONS */
function preloadJS() {
  return src(jsPluginFiles, { allowEmpty: true })
    .pipe(concat("preload.js", { newLine: ";" }))
    .pipe(
      dest("site/scripts/").on("finish", function (callback) {
        console.log("PreloadJS created.");
      })
    );
}

function workScript() {
  return src(scriptFiles, { allowEmpty: true }) /*.pipe(sourcemaps.init())*/
    .pipe(concat("site.js")) /*.pipe(sourcemaps.write())*/
    .pipe(
      dest("site/scripts/").on("finish", () => {
        return src("site/scripts/site.js", {
          allowEmpty: true,
        }) /*.pipe(sourcemaps.init())*/
          .pipe(babel(babelOptions))
          .pipe(
            concat("bluminvoice5.js", { newLine: ";" })
          ) /*.pipe(sourcemaps.write())*/
          .pipe(
            dest("site/scripts/").on("finish", () => {
              return src("site/scripts/site.js", {
                allowEmpty: true,
              }) /*.pipe(sourcemaps.init())*/
                .pipe(terser(terserOptions))
                .pipe(
                  concat("bluminvoice6.js", { newLine: ";" })
                ) /*.pipe(sourcemaps.write())*/
                .pipe(dest("site/scripts/"));
            })
          );
      })
    )
    .pipe(livereload());
}

function bootstrapCSS() {
  return src("source/scss/bootstrap/bootstrap.scss", { allowEmpty: true })
    .pipe(sass.sync(sassOptions).on("error", sass.logError))
    .pipe(postcss([prefix()])) /*.pipe(stripCSS())*/
    .pipe(
      dest("site/styles/").on("finish", function (callback) {
        console.log("BootstrapCSS created.");
      })
    )
    .pipe(livereload());
}

function preloadCSS() {
  return src("source/scss/plugin/preload.sass", { allowEmpty: true })
    .pipe(sourcemaps.init())
    .pipe(sass.sync(sassOptions).on("error", sass.logError))
    .pipe(postcss([prefix()]))
    .pipe(sourcemaps.write())
    .pipe(
      dest("site/styles/").on("finish", function (callback) {
        console.log("PreloadCSS created.");
      })
    )
    .pipe(livereload());
}

function workStyle() {
  return src("source/scss/brandlumin/bluminvoice.sass", { allowEmpty: true })
    .pipe(sourcemaps.init())
    .pipe(sass.sync(sassOptions).on("error", sass.logError))
    .pipe(postcss([prefix()])) /*.pipe(stripCSS())*/
    .pipe(sourcemaps.write())
    .pipe(dest("site/styles/").on("finish", () => livereload.reload()));
}

function workFrontEnd() {
  return src(frontEndFiles, { allowEmpty: true })
    .pipe(htmlmin(htmlminOptions))
    .pipe(dest("site/").on("finish", () => livereload.reload()));
}

/* WATCH FUNCTION */
function watchFiles() {
  watch(bootstrapFiles, bootstrapCSS);
  watch(cssPluginFiles, preloadCSS);
  watch(styleFiles, workStyle);
  watch(jsPluginFiles, preloadJS);
  watch(scriptFiles, workScript);
  watch(frontEndFiles, workFrontEnd);
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
  preloadCSS,
  preloadJS,
  workStyle,
  workScript,
  workFrontEnd,
  parallel(setupServer, watchFiles)
);
exports.styles = series(bootstrapCSS, preloadCSS, workStyle);
exports.scripts = series(preloadJS, workScript);
exports.frontend = series(workFrontEnd);
