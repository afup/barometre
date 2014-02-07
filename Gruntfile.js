module.exports = function(grunt) {

  grunt.initConfig({

    clean: ["web/assets", "app/cache/grunt", "src/Afup/BarometreBundle/Resources/assets/sass/vendor/"],

    copy: {
      main: {
        files: [
          {expand: true, cwd: 'bower_components/select2/', src: ['**.png'], dest: 'web/assets/images/select2/', filter: 'isFile'},
          {expand: true, cwd: 'bower_components/select2/', src: ['**.gif'], dest: 'web/assets/images/select2/', filter: 'isFile'},
          {expand: true, cwd: 'bower_components/bootstrap-sass-official/vendor/assets/fonts/bootstrap/', src: ['*'], dest: 'web/assets/fonts/', filter: 'isFile'},
          {expand: true, cwd: 'bower_components/bootstrap-sass-official/vendor/assets/stylesheets/', src: ['**'], dest: 'src/Afup/BarometreBundle/Resources/assets/sass/vendor/'},
          {expand: true, cwd: 'bower_components/select2/', src: ['select2-bootstrap.scss'], dest: 'src/Afup/BarometreBundle/Resources/assets/sass/vendor/'},
          {expand: true, cwd: 'bower_components/jquery.tablesorter/css/', src: ['theme.bootstrap.css'], dest: 'src/Afup/BarometreBundle/Resources/assets/sass/vendor/', filter: 'isFile',  ext: ".scss"},
          {expand: false, src: 'bower_components/colorbrewer/colorbrewer.css', dest: 'src/Afup/BarometreBundle/Resources/assets/sass/vendor/colorbrewer.scss'}
        ]
      }
    },

    cssUrlRewrite: {
      select2: {
          src: 'bower_components/select2/select2.css',
          dest: 'src/Afup/BarometreBundle/Resources/assets/sass/vendor/select2.scss',
          options: {
            rewriteUrl: function(url, options, dataURI) {
              return '/assets/images/select2/' + url.replace('bower_components/select2/', '');
            }
          }
      }
    },

    sass: {
       dist: {
          options: {
            style: 'expanded'
          },
          src: 'src/Afup/BarometreBundle/Resources/assets/sass/main.scss',
          dest : 'app/cache/grunt/main.css'
       }
    },

    concat: {
      js: {
        options: {
          separator: ';'
        },
        src: [
          'bower_components/jquery/jquery.js',
          'bower_components/select2/select2.js',
          'bower_components/highcharts/highcharts.js',
          'bower_components/highchartTable/jquery.highchartTable.js',
          'bower_components/jquery.tablesorter/js/jquery.tablesorter.js',
          'bower_components/jquery.tablesorter/js/jquery.tablesorter.widgets.js',
          'bower_components/d3/d3.v2.js',
          'src/Afup/BarometreBundle/Resources/assets/js/tablesorter.js',
          'src/Afup/BarometreBundle/Resources/assets/js/main.js',
          'src/Afup/BarometreBundle/Resources/assets/js/map.js'
        ],
        dest: 'app/cache/grunt/main.js'
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
          '<%= sass.dist.dest %>': ['<%= sass.dist.dest %>']
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
      sass : {
        files: [
          'src/Afup/BarometreBundle/Resources/assets/sass/*',
          'src/Afup/BarometreBundle/Resources/assets/sass/ui/*'
        ],
        tasks: ['dev']
      }
    },

    githooks: {
      all: {
        'pre-commit': 'test lint'
      }
    },

    shell: {
        atoum: {
            options: {
                stdout: true,
                failOnError: true
            },
            command: './bin/atoum'
        },
        coke: {
            options: {
                stdout: true,
                failOnError: true
            },
            command: './bin/coke'
        }
    }
  });
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-css-url-rewrite');
  grunt.loadNpmTasks('grunt-hash');
  grunt.loadNpmTasks('grunt-githooks');
  grunt.loadNpmTasks('grunt-shell');

  grunt.registerTask('test', ['shell:atoum']);
  grunt.registerTask('lint', ['shell:coke']);
  grunt.registerTask('common', ['clean', 'copy', 'cssUrlRewrite', 'sass', 'concat']);
  grunt.registerTask('dev', ['common', 'hash']);
  grunt.registerTask('default', ['common', 'uglify', 'cssmin', 'hash']);

};
