import 'bulma';
import '../styles/app.scss';

import { createInertiaApp } from '@inertiajs/svelte';
import LayoutDefault from './layouts/Default.svelte';

createInertiaApp({
  progress: {
    delay: 0,
  },
  resolve: (name) => {
    const pages = import.meta.glob('./Pages/**/*.svelte', { eager: true });
    let page = pages[`./Pages/${name}.svelte`];

    return {
      default: page.default,
      layout: page.layout || LayoutDefault,
    };
  },
  setup({ el, App, props }) {
    new App({ target: el, props });
  },
});
