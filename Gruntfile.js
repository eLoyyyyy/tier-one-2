module.exports = function(grunt){
    
    grunt.initConfig({
        concat: {
            css: {
                src: ['css/*.css', '!css/*.min.css', '!css/style.css'],
                dest: 'css/style.css',
            },
            js: {
                src: ['js/*.js', '!js/*.min.js', '!js/scripts.js'],
                dest: 'js/scripts.js',
            },
        },
        watch: {
            js: {
                files: ['js/*.js', '!js/*.min.js', '!js/scripts.js'],
                tasks: ['concat:js'],
            },
            css: {
                files: ['css/*.css', '!css/*.min.css', '!css/style.css'],
                tasks: ['concat:css'],
            },
        },
    });
  
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.registerTask('default', ['concat', 'watch']);
    
};