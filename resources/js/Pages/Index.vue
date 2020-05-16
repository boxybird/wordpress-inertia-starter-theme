<template>
  <Layout>
    <section class="container space-y-4">
      <article v-for="post in posts" :key="post.id">
        <inertia-link :href="post.link">
          <h3 class="font-bold text-lg">{{ post.title }}</h3>
        </inertia-link>
        <div class="mt-2">{{ post.excerpt }}</div>
      </article>
    </section>
  </Layout>
</template>

<script>
export default {
  props: ['posts']
}
</script>

<style>
</style>