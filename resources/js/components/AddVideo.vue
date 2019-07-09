<template>
  <div>
    <a class="text-text ml-6 text-2xl" href="#" @click.prevent="$modal.show('create-video')">
      <i class="mdi mdi-video-plus"></i>
    </a>

    <modal name="create-video" width="90%" height="90%">
      <create-video @close="$modal.hide('create-video')" :channel="channel"></create-video>
    </modal>
  </div>
</template>

<script>
export default {
  props: ['channel']
}
</script>
