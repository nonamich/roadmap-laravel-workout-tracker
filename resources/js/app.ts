import 'vue-final-modal/style.css';
import './css/app.css';
import './init-dayjs';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h, type DefineComponent } from 'vue';
import { createVfm } from 'vue-final-modal';
import { ZiggyVue } from 'ziggy-js';
import AppLayout from './components/AppLayout.vue';

createInertiaApp({
  async resolve(name) {
    const page = await resolvePageComponent(
      `./pages/${name}.vue`,
      import.meta.glob<DefineComponent>('./pages/**/*.vue'),
    );

    page.default.layout ??= AppLayout;

    return page;
  },
  setup({ el, App, props, plugin }) {
    const vfm = createVfm();

    createApp({ render: () => h(App, props) })
      .use(ZiggyVue)
      .use(vfm)
      .use(plugin)
      .mount(el);
  },
});
