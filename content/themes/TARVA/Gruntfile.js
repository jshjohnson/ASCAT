module.exports = function(grunt) {

  //Load NPM tasks

  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-imageoptim');
  grunt.loadNpmTasks('grunt-svg2png');

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    //Minify JS

    uglify: {
      prod: {
        files: {
          'js/scripts.min.js': ['js/scripts.js', 'js/plugins.js'],
        }
      }
    },

    // Compile Sass

    sass: {
      options: {
        style: 'compressed',
        debugInfo: true,
        sourcemap: 'none'
      },
      dist: {
        files: [{
          expand: true,
          cwd: 'assets/scss',
          src: '**/*.{scss,sass}',
          dest: 'assets/css',
          ext: '.css'
        }]
      }
    },

    // Vendor prefix CSS

    autoprefixer: {
      options: {
        browsers: ['last 8 versions']
      },
      prod: { // Target
        files: [{
          expand: true,
          cwd: 'assets/css',
          src: '**/*.css',
          dest: 'assets/css'
        }]
      }
    },

    // Optimise images

    imageoptim: {
      prod: {
        src: ['assets/img'],
        options: {
          quitAfter: true
        }
      }
    },

    // Rasterise SVGs

    svg2png: {
      prod: {
        files: [
        { src: ['img/**/*.svg'] }
        ]
      }
    },

    // Watch

    watch: {
      scripts: {
        files: ['assets/js/*.js'],
        tasks: ['uglify'],
        options: {
          spawn: false,
        },
      },

      css: {
        files: 'assets/**/*.scss',
        tasks: ['sass', 'autoprefixer:prod'],
        options: {
          livereload: true
        }

      }
    }

  });

  // Build

  grunt.registerTask('default', [
    'svg2png:prod',
    'imageoptim:prod',
    'sass',
    'autoprefixer:prod',
    'uglify:prod'
  ]);

}