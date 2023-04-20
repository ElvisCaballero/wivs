import { defineConfig } from 'vite';
import wordpress from './wordpress.vite';
import { svelte } from '@sveltejs/vite-plugin-svelte';
import path from 'path';

export default defineConfig({
  build: {
    rollupOptions: {
      input: ['src/js/app.js', 'src/styles/admin-style.scss'],
    },
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'src'),
      $lib: path.resolve(__dirname, 'src/js/lib'),
    },
  },
  plugins: [wordpress(), svelte()],
});
