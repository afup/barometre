module.exports = function(grunt) {

  grunt.initConfig({

    clean: ["web/assets", "app/cache/grunt", "src/Afup/BarometreBundle/Resources/assets/sass/vendor/"],

    copy: {
      main: {
        files: [
          {expand: true, cwd: 'bower_components/select2/', src: ['**.png'], dest: 'web/assets/images/select2/', filter: 'isFile'},
          {expand: true, cwd: 'bower_components/select2/', src: ['**.gif'], dest: 'web/assets/images/select2/', filter: 'isFile'},
          {expand: true, cwd: 'bower_components/bootstrap-sass-official/vendor/assets/stylesheets/', src: ['**'], dest: 'src/Afup/BarometreBundle/Resources/assets/sass/vendor/'},
          {expand: true, cwd: 'bower_components/select2/', src: ['select2-bootstrap.scss'], dest: 'src/Afup/BarometreBundle/Resources/assets/sass/vendor/'},
          {expand: false, src: 'bower_components/jquery.tablesorter/css/theme.bootstrap.css', dest: 'src/Afup/BarometreBundle/Resources/assets/sass/vendor/tablesorter.theme.bootstrap.scss'},
          {expand: false, src: 'bower_components/colorbrewer/colorbrewer.css', dest: 'src/Afup/BarometreBundle/Resources/assets/sass/vendor/colorbrewer.scss'},
          {expand: false, src: 'bower_components/github-fork-ribbon-css/gh-fork-ribbon.css',  dest: 'src/Afup/BarometreBundle/Resources/assets/sass/vendor/github-fork-ribbon/gh-fork-ribbon.scss'}
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
      },
      select2bootstrap: {
          src: 'bower_components/select2-bootstrap3-css/lib/select2-bootstrap.scss',
          dest: 'src/Afup/BarometreBundle/Resources/assets/sass/vendor/select2-bootstrap.scss',
      }
    },

    webfont_svg_extractor: {
        glyphicon: {
            options: {
                fontPath: "bower_components/bootstrap/dist/fonts/glyphicons-halflings-regular.svg",
                cssPath: "bower_components/bootstrap/dist/css/bootstrap.css",
                outputDir: "app/cache/grunt/font/",
                preset: "glyphicon",
                icons: [
                    "remove",
                    "chevron-up",
                    "chevron-down"
                ]
            }
        },
        fontawesome: {
            options: {
                fontPath: "bower_components/fontawesome/fonts/fontawesome-webfont.svg",
                cssPath: "bower_components/fontawesome/css/font-awesome.css",
                outputDir: "app/cache/grunt/font/",
                preset: "fontawesome",
                icons: [
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
            src: 'app/cache/grunt/font/*.svg',
            dest: 'web/assets/fonts',
            destCss: 'src/Afup/BarometreBundle/Resources/assets/sass/generated',
            options: {
                templateOptions: {
                    baseClass: 'icon',
                    classPrefix: 'icon-'
                },
                relativeFontPath: '/assets/fonts/',
                htmlDemo: false,
                engine: 'node',
                stylesheet: 'scss'
            }
        }
    },


    sass: {
       dist: {
          options: {
            style: 'expanded'
          },
          src: 'src/Afup/BarometreBundle/Resources/assets/sass/main.scss',
          dest : 'app/cache/grunt/main.css'
       }
    },

    concat: {
      js: {
        options: {
          separator: ';'
        },
        nonull: true,
        src: [
          'bower_components/jquery/dist/jquery.js',
          'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/dropdown.js',
          'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/transition.js',
          'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/collapse.js',
          'bower_components/select2/select2.js',
          'bower_components/select2/select2_locale_fr.js',
          'bower_components/highcharts/highcharts.js',
          'bower_components/highchartTable/jquery.highchartTable.js',
          'bower_components/jquery.tablesorter/js/jquery.tablesorter.js',
          'bower_components/jquery.tablesorter/js/jquery.tablesorter.widgets.js',
          'bower_components/d3/d3.v2.js',
          'src/Afup/BarometreBundle/Resources/assets/js/tablesorter.js',
          'src/Afup/BarometreBundle/Resources/assets/js/select2.js',
          'src/Afup/BarometreBundle/Resources/assets/js/charts.js',
          'src/Afup/BarometreBundle/Resources/assets/js/filters.js',
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
          src: 'app/cache/grunt/main.js',
          dest: 'web/assets/js/'
      },
      css: {
        src: 'app/cache/grunt/main.css',
        dest: 'web/assets/css/'
      },
      logos: {
        src: 'src/Afup/BarometreBundle/Resources/assets/logos/*',
        dest: 'web/assets/logos/'
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
      },
      sasslint : {
        files: [
            'src/Afup/BarometreBundle/Resources/assets/sass/*',
            'src/Afup/BarometreBundle/Resources/assets/sass/ui/*'
        ],
        tasks: ['sasslint']
      },
      gruntfile: { files: ['Gruntfile.js'], tasks: ['dev']  }
    },

    jshint: {
      options: {
        jshintrc: true
      },
      src: ['src/Afup/BarometreBundle/Resources/assets/js/*']
    },

    sasslint: {
      options: {
          configFile: ".sass-lint.yml"
      },
      target: ['src/Afup/BarometreBundle/Resources/assets/sass/**']
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
    },
    favicons: {
      options: {
        trueColor: true,
        precomposed: true,
        appleTouchBackgroundColor: "#ffffff",
        html: 'app/Resources/views/favicons/favicons.html',
        HTMLPrefix: '/assets/favicons/'
      },
      icons: {
        src: 'src/Afup/BarometreBundle/Resources/assets/favicon/favicon.png',
        dest: 'web/assets/favicons/'
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
  grunt.loadNpmTasks('grunt-favicons');

  grunt.registerTask('test', ['shell:atoum']);
  grunt.registerTask('lint', ['shell:coke', 'jshint', 'sasslint']);
  grunt.registerTask('common', ['clean', 'copy', 'cssUrlRewrite', 'webfont_svg_extractor', 'webfont', 'sass', 'concat', 'favicons']);
  grunt.registerTask('dev', ['common', 'filerev']);
  grunt.registerTask('default', ['common', 'uglify', 'cssmin', 'filerev']);

};
