var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var watch = require('gulp-watch');
var reload = browserSync.reload


gulp.task('default', function(){
	
	browserSync.init({
		port : 8888,
		proxy: "localhost:8888",
		local : "http://localhost:8888/HETIC/annee_3/cours_wordpress/BTM/",
        
    });
	gulp.watch('js/**').on('change', reload);
	gulp.watch('css/**').on('change', reload);
	gulp.watch('*.php').on('change', reload);

});