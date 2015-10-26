var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var watch = require('gulp-watch');
var reload = browserSync.reload

gulp.task('default', function(){

	browserSync.init({
        proxy: "http://localhost:8888/HETIC/annee_3/cours_wordpress/BTM/"
    });
	gulp.watch('js/**').on('change', reload);
	
});