<template>
  <Layout>
    <section class="container">
      <h1 class="font-bold text-lg">{{ page.post_title }}</h1>
      <div class="rich-text mt-4" v-html="page.post_content"></div>
    </section>
  </Layout>
</template>

<script>
export default {
  props: ['page']
}
</script>

<style>
</style>