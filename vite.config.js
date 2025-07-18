import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import path from 'node:path';
import { defineConfig, loadEnv } from 'vite';
import { watch } from 'vite-plugin-watch';

const port = 5173;

export default defineConfig(({ mode }) => {
  const env = loadEnv(mode, process.cwd());

  return {
    server: {
      host: env.VITE_SERVER_HOST ? env.VITE_SERVER_HOST : undefined,
      port,
      origin: env.VITE_SERVER_ORIGIN
        ? `${env.VITE_SERVER_ORIGIN.replace(/:\d+$/, '')}:${port}`
        : undefined,
      cors: true,
    },
    plugins: [
      tailwindcss(),
      laravel({
        input: ['resources/js/app.ts'],
        refresh: true,
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
        command: 'composer data:typescript',
        onInit: false,
      }),
    ],
    resolve: {
      alias: {
        '@': path.resolve(__dirname, './resources/js'),
      },
    },
  };
});
