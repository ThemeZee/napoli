// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var rename       = require( 'gulp-rename' );
var concat       = require( 'gulp-concat' );
var uglify       = require( 'gulp-uglify' );
var postcss      = require( 'gulp-postcss' );
var sourcemaps   = require( 'gulp-sourcemaps' );
var autoprefixer = require( 'autoprefixer' );
var sorting      = require( 'postcss-sorting' );
var rtlcss       = require( 'gulp-rtlcss' );
var wprtl        = require( 'postcss-wprtl' );
var duplicates   = require( 'postcss-discard-duplicates' );

// Minify JS
gulp.task( 'minifyjs', function() {
	return gulp.src( ['js/navigation.js'] )
		.pipe( uglify() )
		.pipe( rename( {
			suffix: '.min'
		} ) )
		.pipe( gulp.dest('js') );
});

// Autoprefix CSS
gulp.task( 'autoprefix', function() {
	return gulp.src( ['style.css', 'css/*.css'], { base: './' } )
		.pipe( postcss( [ autoprefixer() ] ) )
		.pipe( gulp.dest( './' ) );
});

// Sort CSS
gulp.task( 'sorting', function() {
	return gulp.src( ['style.css', 'css/*.css'], { base: './' } )
		.pipe( postcss( [ sorting( { 'preserve-empty-lines-between-children-rules': true } ) ] ) )
		.pipe( gulp.dest( './' ) );
});

// WP RTL
gulp.task( 'wprtl', function () {
	return gulp.src( 'style.css' )
		.pipe( postcss( [ wprtl() ] ) )
		.pipe( rtlcss() )
		.pipe( postcss( [ duplicates() ] ) )
		.pipe( postcss( [ sorting( { 'preserve-empty-lines-between-children-rules': true } ) ] ) )
		.pipe( rename( 'rtl.css' ) )
		.pipe( gulp.dest( './' ) );
});

// Flex RTL
gulp.task( 'flexrtl', function () {
	return gulp.src( 'css/flexslider.css' )
		.pipe( rtlcss() )
		.pipe( rename( {
			suffix: '-rtl'
		} ) )
		.pipe( gulp.dest( 'css' ) );
});

// Default Task
gulp.task( 'default', ['minifyjs', 'autoprefix', 'sorting'] );
