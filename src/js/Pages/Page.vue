<template>
  <section>
    <h1>Page:</h1>
    <h3>{{ props.page.post_title }}</h3>
    <div v-html="props.page.post_content"></div>
  </section>
</template>

<script setup>

import { usePage } from '@inertiajs/inertia-vue3'

const { props } = usePage()

</script>

<style></style>
