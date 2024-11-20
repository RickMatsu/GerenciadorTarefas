import '../css/app.css';
import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import { createApp } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from 'ziggy-js';  // Verifique o caminho do Ziggy
import App from './App.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')  // Este código carrega as páginas Vue de forma dinâmica
        ),
    setup({ el, App, props, plugin }) {
        return createApp(App, props)
            .use(plugin)   // Usa o plugin do Inertia
            .use(ZiggyVue) // Usa o ZiggyVue para as rotas nomeadas
            .mount(el);
    },
    progress: {
        color: '#4B5563',  // Cor da barra de progresso
    },
});

