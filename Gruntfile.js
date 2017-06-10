module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        sass: {
            dist: {
                files: {
                    'style.css' : 'sass/style.scss'
                }
            }
        },
        cssmin: {
            target: {
                files: [{
                    expand: true,
                    src: ['style.css'],
                    dest: '.',
                    ext: '.min.css'
                }]
            }
        },
        watch: {
            css: {
                files: '**/*.scss',
                tasks: ['sass', 'cssmin']
            }
        }
    });
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.registerTask('default',['watch']);
}
