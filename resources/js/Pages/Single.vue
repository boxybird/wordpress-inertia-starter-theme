<template>
  <Layout>
    <section class="container">
      <article>
        <h3 class="font-bold text-lg">{{ post.title }}</h3>
        <div class="rich-text mt-4" v-html="post.content"></div>
      </article>
    </section>
  </Layout>
</template>

<script>
export default {
  props: ['post']
}
</script>

<style>
</style>