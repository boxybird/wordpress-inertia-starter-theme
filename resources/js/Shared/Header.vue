<template>
  <header class="bg-gray-200">
    <div class="container flex justify-between py-4">
      <inertia-link href="/">
        <h1>{{ $page.site.name }}</h1>
      </inertia-link>
      <ul class="flex space-x-4">
        <li v-for="item in $page.primary_menu" :key="item.id">
          <inertia-link :href="item.link">{{ item.name }}</inertia-link>
        </li>
      </ul>
    </div>
  </header>
</template>

<script>
export default {}
</script>

<style>
</style>