const { series } = require("gulp")
const gulp = require("gulp")
const sass = require("gulp-sass")(require("sass"))

function style() {
	return gulp
		.src("./assets/scss/*.scss")
		.pipe(
			sass({
				includePaths: ["./"],
			})
		)
		.on("error", sass.logError)
		.pipe(gulp.dest("./assets/css"))
}

function watchFiles(done) {
	gulp.watch("./assets/scss/**/*", style)
	done()
}

exports.style = style
exports.default = series(style, watchFiles)
