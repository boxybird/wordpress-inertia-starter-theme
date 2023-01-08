import path from 'path'
import { defineConfig } from 'vite'
import VitePluginVue from '@vitejs/plugin-vue'
import VitePluginFullReload from 'vite-plugin-full-reload'

const themeDirName = path.basename(__dirname)

export default defineConfig({
  plugins: [
    VitePluginVue(),
    VitePluginFullReload([
      './**/*.php'
    ])
  ],
  base: process.env.NODE_ENV === 'development' ?
    '/' :
    '/wp-content/themes/' + themeDirName + '/dist/',
  server: {
    port: 3000,
    strictPort: true
  },
  build: {
    minify: false,
    manifest: true,
    emptyOutDir: true,
    outDir: 'dist',
    target: 'es2015',
    rollupOptions: {
      input: {
        app: 'src/js/app.js'
      },
      output: {
        entryFileNames: 'app.js'
      }
    },
  },
  resolve: {
    alias: {
      '@': '/js'
    }
  }
})