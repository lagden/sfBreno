'use strict'

module.exports = (grunt) ->
  require('load-grunt-tasks') grunt
  require('time-grunt') grunt
  grunt.file.defaultEncoding = 'utf8'
  grunt.initConfig
    xo:
      options:
        quiet: true
        ignores: []
      target: ['es6/**/*.js']

    babel:
      compile:
        options:
          sourceMap: true
          modules: 'amd'
        files: [
          expand: true
          flatten: false
          cwd: 'es6'
          src: [
            'app/**/*.js'
            'component/**/*.js'
            'lib/**/*.js'
          ]
          dest: 'web/js2'
          ext: '.js'
        ]
      base:
        options:
          sourceMap: true
        files: [
          expand: true
          flatten: false
          cwd: 'es6'
          src: ['*.js']
          dest: 'web/js2'
          ext: '.js'
        ]

    requirejs:
      almond:
        options:
          optimize: 'uglify2'
          uglify2:
            warnings: false
            mangle: true
            compress:
              evaluate: false
              sequences: true
              properties: true
              unused: true
              hoist_funs: false
              hoist_vars: false
              drop_debugger: true
              drop_console: true
          optimizeCss: 'none'
          generateSourceMaps: false
          keepAmdefine: true
          preserveLicenseComments: false
          findNestedDependencies: true
          useStrict: false
          baseUrl: 'web/js2/lib'
          mainConfigFile: 'web/js2/config.js'
          name: '../../../node_modules/almond/almond',
          include: [ '../app' ]
          out: 'web/js3/main.min.js'

    stylus:
      dev:
        options:
          compress: true
          paths: [
            'node_modules/jeet/stylus'
            'node_modules/rupture'
            'node_modules/nib'
          ]
          import: [
            'jeet'
            'rupture'
            'nib/normalize'
            'nib/image'
          ]
        files: [
          expand: true
          flatten: false
          cwd: 'stylus'
          src: ['*.styl']
          dest: 'web/css2'
          ext: '.css'
        ]

    postcss:
      dev:
        options:
          processors: [
            require('autoprefixer-core')(browsers: 'last 2 versions')
          ]
        files: [
          expand: true
          flatten: false
          cwd: 'web/css2'
          src: ['*.css']
          dest: 'web/css2'
          ext: '.css'
        ]

    svg_sprite:
      basic:
        expand: true
        flatten: false
        cwd: 'svg'
        src: ['**/*.svg']
        dest: 'web/assets'
        options:
          mode:
            symbol:
              dest: '.'
              sprite: 'sprites.svg'
              example: false
          svg:
            xmlDeclaration: false
            doctypeDeclaration: false
            rootAttributes:
              width: 0
              height: 0
              display: 'none'
              version: '1.1'
              'aria-hidden': 'true'
          shape:
            id:
              separator: '_'

    watch:
      scripts:
        files: ['es6/**/*.js']
        tasks: ['scripts', 'clean']
      styles:
        files: ['stylus/**/*.styl']
        tasks: ['styles', 'clean']

    concurrent:
      dev: [
        'clean'
        'scripts'
        'styles'
        'svg_sprite'
      ]

    symlink:
      options:
        overwrite: true
      require:
        src: 'node_modules/requirejs/require.js'
        dest: 'web/js2/lib/require.js'
      jquery:
        src: 'node_modules/jquery/dist/jquery.js'
        dest: 'web/js2/lib/jquery.js'
      svglocalstorage:
        src: 'node_modules/svg-localstorage/svg-localstorage.js'
        dest: 'web/js2/lib/svg-localstorage.js'
      githubMarkdownCss:
        src: 'node_modules/github-markdown-css/github-markdown.css'
        dest: 'web/css2/github-markdown.css'
      # mout:
      #   files: [
      #     expand: true
      #     overwrite: true
      #     cwd: 'bower/mout/src'
      #     src: [
      #       '**/*.js'
      #     ]
      #     dest: 'web/js2/lib/mout'
      #   ]

    clean:
      cache: ['cache/*']
      log: ['log/*']

  grunt.registerTask 'default', [
    'symlink'
    'concurrent:dev'
  ]

  grunt.registerTask 'scripts', [
    'xo'
    'babel'
  ]

  grunt.registerTask 'styles', [
    'stylus'
    'postcss'
  ]

  grunt.registerTask 'build', [
    'default'
    'requirejs'
  ]

  grunt.registerTask 'w', [
    'default'
    'watch'
  ]

  return
