import 'vite/modulepreload-polyfill'
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import Layout from './shared/Layout.vue'

InertiaProgress.init()

createInertiaApp({
  resolve: (name) => {

    const page = import(`./Pages/${name}.vue`)

    // Use global layout for all pages, unless overridden by individual page.
    page.layout ??= Layout

    return page

  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})
