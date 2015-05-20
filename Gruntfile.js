module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      options: {
        includePaths: ['public/bower/bootstrap-sass/assets/stylesheets/'],
        sourceMap: true
      },
      dist: {
        options: {
          outputStyle: 'nested'
        },
        files: {
          'public/css/style.css': 'sass/style.scss'
        }        
      }
    },    
    watch: {
      grunt: { files: ['Gruntfile.js'] },
      sass: {
        files: ['sass/**/*.scss', 'public/**/*.scss'],
        tasks: ['sass']
      }
    }
  });

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.registerTask('build', ['sass']);
  grunt.registerTask('default', ['build','watch']);
}