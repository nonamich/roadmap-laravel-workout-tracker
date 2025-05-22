import 'vue-final-modal/style.css';
import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { createApp, h, type DefineComponent } from 'vue';
import { createVfm } from 'vue-final-modal';
import AppLayout from './Components/AppLayout.vue';

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob<DefineComponent>('./Pages/**/*.vue', {
            eager: true,
        });
        const page = pages[`./Pages/${name}.vue`];

        page.default.layout = page.default.layout || AppLayout;

        return page;
    },
    setup({ el, App, props, plugin }) {
        const vfm = createVfm();

        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(vfm)
            .mount(el);
    },
});
