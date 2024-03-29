const sass = require('node-sass');

module.exports = function(grunt) {

  grunt.initConfig({

    clean: ["public/assets", "var/cache/grunt", "assets/sass/vendor/"],

    copy: {
      main: {
        files: [
          {expand: true, cwd: 'node_modules/bootstrap-sass/assets/stylesheets/', src: ['**'], dest: 'assets/sass/vendor/'},
          {expand: true, cwd: 'node_modules/select2/dist/css/', src: ['select2.css'], dest: 'assets/sass/vendor/'},
          {expand: true, cwd: 'node_modules/select2-bootstrap-theme/src/', src: ['select2-bootstrap.scss'], dest: 'assets/sass/vendor/'},
          {expand: false, src: 'node_modules/tablesorter/dist/css/theme.bootstrap.css', dest: 'assets/sass/vendor/tablesorter.theme.bootstrap.scss'},
          {expand: false, src: 'node_modules/colorbrewer/colorbrewer.css', dest: 'assets/sass/vendor/colorbrewer.scss'},
          {expand: false, src: 'node_modules/github-fork-ribbon-css/gh-fork-ribbon.css',  dest: 'assets/sass/vendor/github-fork-ribbon/gh-fork-ribbon.scss'},
          {expand: true, cwd: 'node_modules/tarteaucitronjs/', src: ['*.js', 'lang/tarteaucitron.fr.js'], dest: 'public/js/tarteaucitron/'},
        ]
      }
    },

    webfont_svg_extractor: {
        fontawesome: {
            options: {
                fontPath: "node_modules/font-awesome/fonts/fontawesome-webfont.svg",
                cssPath: "node_modules/font-awesome/css/font-awesome.css",
                outputDir: "var/cache/grunt/font/",
                preset: "fontawesome",
                icons: [
                    "chevron-up",
                    "chevron-down",
                    "remove",
                    "smile-o",
                    "frown-o",
                    "male",
                    "female",
                    "apple",
                    "linux",
                    "windows"
                ]
            }
        }
    },

    webfont: {
        icons: {
            src: 'var/cache/grunt/font/*.svg',
            dest: 'public/assets/fonts',
            destCss: 'assets/sass/generated',
            options: {
                templateOptions: {
                    baseClass: 'icon',
                    classPrefix: 'icon-'
                },
                relativeFontPath: '/assets/fonts/',
                htmlDemo: false,
                fontHeight: 1024,
                engine: 'node',
                stylesheet: 'scss',
                types: 'eot,woff,ttf,svg'
            }
        }
    },


    sass: {
       options: {
           implementation: sass,
       },
       dist: {
          options: {
            style: 'expanded'
          },
          src: 'assets/sass/main.scss',
          dest : 'var/cache/grunt/main.css'
       }
    },

    concat: {
      js: {
        options: {
          separator: ';'
        },
        nonull: true,
        src: [
          'node_modules/jquery/dist/jquery.js',
          'node_modules/bootstrap-sass/assets/javascripts/bootstrap/dropdown.js',
          'node_modules/bootstrap-sass/assets/javascripts/bootstrap/transition.js',
          'node_modules/bootstrap-sass/assets/javascripts/bootstrap/collapse.js',
          'node_modules/select2/dist/js/select2.js',
          'node_modules/select2/dist/js/i18n/fr.js',
          'node_modules/highcharts/highcharts.js',
          'node_modules/highchartTable/jquery.highchartTable.js',
          'node_modules/tablesorter/js/jquery.tablesorter.js',
          'node_modules/tablesorter/js/jquery.tablesorter.widgets.js',
          'node_modules/d3/d3.v2.js',
          'assets/js/tablesorter.js',
          'assets/js/select2.js',
          'assets/js/charts.js',
          'assets/js/filters.js',
          'assets/js/map.js'
        ],
        dest: 'var/cache/grunt/main.js'
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
      options: {
        keepSpecialComments: 0
      },
      css: {
        files: {
          '<%= sass.dist.dest %>': ['<%= sass.dist.dest %>']
        }
      }
    },
    filerev: {
      options: {
        algorithm: 'sha1',
        length: 8
      },
      js: {
          src: 'var/cache/grunt/main.js',
          dest: 'public/assets/js/'
      },
      css: {
        src: 'var/cache/grunt/main.css',
        dest: 'public/assets/css/'
      },
      logos: {
        src: 'assets/logos/*',
        dest: 'public/assets/logos/'
      }
    },

    watch: {
      js: {
        files: ['assets/js/**'],
        tasks: ['dev']
      },
      sass : {
        files: [
          'assets/sass/*',
          'assets/sass/ui/*'
        ],
        tasks: ['dev']
      },
      sasslint : {
        files: [
            'assets/sass/*',
            'assets/sass/ui/*'
        ],
        tasks: ['sasslint']
      },
      gruntfile: { files: ['Gruntfile.js'], tasks: ['dev']  }
    },

    jshint: {
      options: {
        jshintrc: true
      },
      src: ['assets/js/*']
    },

    sasslint: {
      options: {
          configFile: ".sass-lint.yml"
      },
      target: ['assets/sass/**']
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
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-css-url-rewrite');
  grunt.loadNpmTasks('grunt-filerev');
  grunt.loadNpmTasks('grunt-githooks');
  grunt.loadNpmTasks('grunt-shell');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-sass-lint');
  grunt.loadNpmTasks('grunt-webfont');
  grunt.loadNpmTasks('grunt-webfont-svg-extractor');

  grunt.registerTask('test', ['shell:atoum']);
  grunt.registerTask('lint', ['shell:coke', 'jshint', 'sasslint']);
  grunt.registerTask('common', ['clean', 'copy', 'webfont_svg_extractor', 'webfont', 'sass', 'concat']);
  grunt.registerTask('dev', ['common', 'filerev']);
  grunt.registerTask('default', ['common', 'uglify', 'cssmin', 'filerev']);

};
