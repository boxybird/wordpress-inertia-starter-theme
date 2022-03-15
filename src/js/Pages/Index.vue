<template>
  <section class="container space-y-4">
    <h1>List of Posts:</h1>
    <article v-for="post in props.posts" :key="post.ID">
      <Link :href="post.post_name">
        <h3 class="font-bold text-lg">{{ post.post_title }}</h3>
      </Link>
    </article>
  </section>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3'

const { props } = usePage()
</script>

<style></style>
