const { configure } = require('quasar/wrappers');

module.exports = configure(function (/* ctx */) {
  return {
    framework: {
      config: {},
      plugins: [
        'Notify' // Asegúrate de que Notify esté aquí
      ]
    },

    boot: [
      // Aquí puedes añadir tus boot files si es necesario
    ],

    css: [
      'app.scss'
    ],

    extras: [
      'roboto-font', // optional
      'material-icons', // optional
    ],

    build: {
      target: {
        browser: ['es2019', 'edge88', 'firefox78', 'chrome87', 'safari13.1'],
        node: 'node20'
      },
      vueRouterMode: 'hash', // available values: 'hash', 'history'
      vitePlugins: [
        ['vite-plugin-checker', {
          vueTsc: {
            tsconfigPath: 'tsconfig.vue-tsc.json'
          },
          eslint: {
            lintCommand: 'eslint "./**/*.{js,ts,mjs,cjs,vue}"'
          }
        }, { server: false }]
      ]
    },

    devServer: {
      open: true // opens browser window automatically
    },

    ssr: {
      pwa: false,
      prodPort: 3000,
      middlewares: [
        'render' // keep this as last one
      ]
    },

    pwa: {
      workboxMode: 'generateSW',
      injectPwaMetaTags: true,
      swFilename: 'sw.js',
      manifestFilename: 'manifest.json',
      useCredentialsForManifestTag: false,
    },

    cordova: {
      // noIosLegacyBuildFlag: true,
    },

    capacitor: {
      hideSplashscreen: true
    },

    electron: {
      inspectPort: 5858,
      bundler: 'packager',
      packager: {},
      builder: {
        appId: 'frontend'
      }
    },

    bex: {
      contentScripts: [
        'my-content-script'
      ],
    }
  }
});
