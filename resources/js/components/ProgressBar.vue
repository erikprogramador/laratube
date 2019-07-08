<template>
  <div class="w-full h-6 bg-side-focus rounded overflow-hidden relative">
    <div class="h-full bg-main" :style="`width: ${progress}%;`"></div>
    <span class="load-number text-sm absolute pin-t text-default font-semibold">{{ progress }}%</span>
  </div>
</template>

<script>
export default {
  props: ['progress']
}
</script>

<style scoped>
.load-number {
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
