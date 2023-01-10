import path from 'path'
import { defineConfig, splitVendorChunkPlugin } from 'vite'
import VitePluginVue from '@vitejs/plugin-vue'
import VitePluginFullReload from 'vite-plugin-full-reload'

const themeDirName = path.basename(__dirname)

export default defineConfig({
  plugins: [
    // splitVendorChunkPlugin(),
    VitePluginVue(),
    VitePluginFullReload([
      './**/*.php'
    ])
  ],
  base: process.env.NODE_ENV === 'development' ?
    '/' :
    '/wp-content/themes/' + themeDirName + '/dist/',
  server: {
    watch: {
      // watch all vue files
      
    },
    port: 3000,
    strictPort: true
  },
  build: {
    minify: false,
    manifest: true,
    emptyOutDir: true,
    outDir: 'dist',
    rollupOptions: {
      input: {
        app: 'src/js/app.js'
      }
    },
  },
  resolve: {
    alias: {
      '@': '/js'
    }
  }
})
