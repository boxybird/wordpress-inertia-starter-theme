<template>
  <div>
    <Header />
    <main class="mt-4">
      <slot></slot>
    </main>
    <Footer />
  </div>
</template>

<script>
import Header from './Header.vue'
import Footer from './Footer.vue'

export default {
  components: {
    Header,
    Footer
  }
}
</script>

<style>
</style>