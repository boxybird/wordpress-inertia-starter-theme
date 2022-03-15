<template>
  <section>
    <h1>404:</h1>
    <h3>{{ props.content }}</h3>
  </section>
</template>

<script setup>
import { usePage } from '@inertiajs/inertia-vue3'

const { props } = usePage()
</script>

<style></style>
