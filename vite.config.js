import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import path from 'node:path';
import { defineConfig } from 'vite';
import { watch } from 'vite-plugin-watch';

const port = 5173;

export default defineConfig({
  server: {
    host: '0.0.0.0',
    port,
    strictPort: true,
    origin: `${process.env.DDEV_PRIMARY_URL.replace(/:\d+$/, '')}:${port}`,
    cors: {
      origin: /https?:\/\/([A-Za-z0-9\-\.]+)?(\.ddev\.site)(?::\d+)?$/,
    },
  },
  plugins: [
    tailwindcss(),
    laravel({
      input: ['resources/js/app.ts'],
      refresh: false,
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
    watch({
      pattern: 'app/{Data,Enums}/**/*.php',
      command: 'php artisan typescript:transform --format',
    }),
    watch({
      pattern: ['routes/web.php', 'routes/web/**/*.php'],
      command: 'php artisan ziggy:generate --types resources/js/router/ziggy',
    }),
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './resources/js'),
    },
  },
});
