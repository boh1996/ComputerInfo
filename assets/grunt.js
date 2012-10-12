module.exports = function(grunt) {
  grunt.initConfig({
    concat: {
      lib_js : {
        src: [
          'js/jquery.dataTables.min.js',
          'js/custom-form-elements.js',
          'js/dataTables.bootstrap.js',
          'js/FixedHeader.js',
          'js/html5shiv.js',
          'js/jquery.jqtransform.js',
          'js/objx.js',
          'js/jquery.history.js',
        ],
        dest: 'js/assets.js'
      },
      application_js : {
          src: [
            "js/settings.js",
            "js/tableGenerator.js",
            "js/userInfo.js",
            "js/application.js",
            "js/script.js"
          ],
          dest: "js/app.js"
      },
      lib_css : {
        src: [
          'css/dataTables.bootstrap.css',
          'css/jquery.dataTables.css',
          'css/jqtransform.css'
        ],
        dest: 'css/assets.css'
      },
      application_css : {
        src: [
          'css/form.css',
          'css/loading.css',
          'css/style.css',
          "css/user.css"
        ],
        dest: 'css/application.css'
      }
    },
    min: {
      lib_js: {
        src: 'js/assets.js',
        dest: 'js/assets.min.js'
      },
      application_js : {
        src: "js/app.js",
        dest : "js/app.min.js"
      }
    },
    mincss: {
      compress: {
        files: {
         "css/assets.min.css": "css/assets.css",
         "css/application.min.css": "css/application.css"
        }
      }
    },
  });

  grunt.loadNpmTasks('grunt-contrib-mincss');

  grunt.registerTask('default', 'concat concat min mincss');
};