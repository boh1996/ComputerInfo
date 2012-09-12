module.exports = function(grunt) {
  grunt.initConfig({
    concat: {
      dist : {
        src: ['js/*.js'],
        dest: 'build/build.js'
      }
    },
    min: {
      dist: {
        src: ['build/build.js'],
        dest: 'build/build.min.js'
      }
    },
  });

  grunt.registerTask('default', 'concat min');
};