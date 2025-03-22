import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import PrimeVue from "primevue/config";
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import "primevue/resources/themes/lara-light-amber/theme.css";
import "primevue/resources/primevue.min.css";
import "primeicons/primeicons.css";
import assetsMixin from "./assets.js";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app
            .use(plugin)
            .use(PrimeVue)
            .mixin(assetsMixin)
            .use(ZiggyVue)
            .mount(el);

        return app;
    },
    progress: {
        color: '#F19029',
        showSpinner: true,
        delay: 250,
    },
});
