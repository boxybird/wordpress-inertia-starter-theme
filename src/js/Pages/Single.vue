<template>
  <article>
    <h1>Single Post:</h1>
    <h3>{{ props.post.post_title }}</h3>
    <div v-html="props.post.post_content"></div>
  </article>
</template>

<script setup>

import { usePage } from '@inertiajs/inertia-vue3'

const { props } = usePage()

</script>

<style></style>
