module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        uglify: {
            default: {
            }
        },

        cssmin: {
            default: {
            }
        }
    });

    // Ici on indique quel plugin on utilise
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    // La tâche par défaut qui va s'éxécuter lorsque l'on tape "grunt" dans le terminal
    grunt.registerTask('default', ['uglify', 'cssmin']);
};
