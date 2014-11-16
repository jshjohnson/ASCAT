module.exports = function(grunt) {

    require('time-grunt')(grunt);

    require('load-grunt-tasks')(grunt); // npm install --save-dev load-grunt-tasks

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        //Minify JS

        uglify: {
            dist: {
                files: {
                    'assets/js/scripts.min.js': ['assets/js/scripts.js', 'assets/js/plugins.js'],
                }
            }
        },

        // Compile Sass

        sass: {
            options: {
                style: 'expanded',
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
            dist: { // Target
                files: [{
                    expand: true,
                    cwd: 'assets/css',
                    src: '**/*.css',
                    dest: 'assets/css'
                }]
            }
        },

        // Optimise images

        imagemin: {
            dist: {
                options: {
                    progressive: true
                },
                files: [{
                    expand: true,
                    cwd: 'assets/img',
                    src: '**/*.{jpg,jpeg,png}',
                    dest: 'assets/img'
                }]
            }
        },

        svgmin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: 'assets/img/',
                    src: ['**/*.svg'],
                    dest: 'assets/img/'
                }]
            }
        },

        // Rasterise SVGs

        svg2png: {
            dist: {
                files: [{
                    cwd: 'assets/img/',
                    src: ['**/*.svg'],
                    dest: 'assets/img/'
                }]
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

            sass: {
                files: 'assets/**/*.scss',
                tasks: ['sass', 'autoprefixer:dist'],
                options: {
                    livereload: true
                }
            },

            images: {
                files: 'assets/img/**/*',
                tasks: ['svgmin', 'svg2png', 'imagemin'],
            }
        }

    });

    // Default

    grunt.registerTask('dev', [
        'watch'
    ]);

    // Build

    grunt.registerTask('build', [
        'svgmin:dist',
        'svg2png:dist',
        'imagemin:dist',
        'sass:dist',
        'autoprefixer:dist',
        'uglify:dist'
    ]);

}