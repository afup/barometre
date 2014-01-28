module.exports = function(grunt) {

  grunt.initConfig({

    clean: ["web/assets", "app/cache/grunt"],

    copy: {
      main: {
        files: [
          {expand: true, cwd: 'bower_components/select2/', src: ['**.png'], dest: 'web/assets/images/select2/', filter: 'isFile'},
          {expand: true, cwd: 'bower_components/select2/', src: ['**.gif'], dest: 'web/assets/images/select2/', filter: 'isFile'},
          {expand: true, cwd: 'bower_components/bootstrap/dist/fonts/', src: ['*'], dest: 'web/assets/fonts/', filter: 'isFile'}
        ]
      }
    },

    cssUrlRewrite: {
      select2: {
          src: 'bower_components/select2/select2.css',
          dest: 'app/cache/grunt/select2.css',
          options: {
            rewriteUrl: function(url, options, dataURI) {
              return '/assets/images/select2/' + url.replace('bower_components/select2/', '');
            }
          }
      },
    },

    concat: {
      js: {
        options: {
          separator: ';'
        },
        src: [
          'bower_components/jquery/jquery.js',
          'bower_components/select2/select2.js',
          'src/Afup/BarometreBundle/Resources/assets/js/main.js',

        ],
        dest: 'app/cache/grunt/main.js'
      },
      css: {
        options: {
          separator: ''
        },
        src: [
          'bower_components/bootstrap/dist/css/bootstrap.css',
          'app/cache/grunt/select2.css',
          'bower_components/select2/select2-bootstrap.css',
          'src/Afup/BarometreBundle/Resources/assets/css/main.css',
        ],
        dest: 'app/cache/grunt/main.css'
      }
    },
     uglify: {
      js: {
        files: {
          '<%= concat.js.dest %>': ['<%= concat.js.dest %>']
        }
      }
    },

    cssmin: {
      css: {
        files: {
          '<%= concat.css.dest %>': ['<%= concat.css.dest %>']
        }
      }
    },


    hash: {
      options: {
         hashLength: 8,
         hashFunction: function(source, encoding){
              return require('crypto').createHash('sha1').update(source, encoding).digest('hex');
         }
      },
      js: {
          src: 'app/cache/grunt/main.js',
          dest: 'web/assets/js/'
      },
      css: {
          src: 'app/cache/grunt/main.css',
          dest: 'web/assets/css/'
      }
    },

    watch: {
      js: {
        files: ['src/Afup/BarometreBundle/Resources/assets/js/**'],
        tasks: ['dev']
      },
      css : {
        files: ['src/Afup/BarometreBundle/Resources/assets/css/**'],
        tasks: ['dev']
      }
    }
  });
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-css-url-rewrite');
  grunt.loadNpmTasks('grunt-hash');

  grunt.registerTask('dev', ['clean', 'copy', 'cssUrlRewrite', 'concat', 'hash']);
  grunt.registerTask('default', ['dev', 'uglify', 'cssmin']);

};
