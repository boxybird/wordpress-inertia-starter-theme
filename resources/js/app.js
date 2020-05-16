import Vue from 'vue'
import Layout from './Shared/Layout.vue'
import { InertiaApp } from '@inertiajs/inertia-vue'

Vue.use(InertiaApp)

Vue.component('Layout', Layout)

const app = document.getElementById('app')

new Vue({
  render: h => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: name => require(`./Pages/${name}`).default,
    },
  }),
}).$mount(app)