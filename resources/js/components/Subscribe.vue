<template>
  <form action="#">
    <button
      class="py-2 px-6 uppercase tracking-loose rounded"
      :class="subscribed ? 'bg-side-focus text-text' : 'bg-main text-default'"
      @click.prevent="subscribe"
    >
      {{ subscribed ? 'Inscrito' : 'Increver-se' }}
      <span>{{ subscriptions }}</span>
    </button>
  </form>
</template>

<script>
export default {
  props: ['channel', 'subscriptions', 'dataSubscribed'],

  data() {
    return {
      subscribed: this.dataSubscribed
    }
  },

  methods: {
    async subscribe() {
      try {
        const method = this.subscribed ? 'delete' : 'post'
        const url = this.subscribed ? 'unsubscribe' : 'subscribe'

        const response = await axios[method]('/' + url + '/' + this.channel.slug)
        this.subscribed = !this.subscribed
      } catch (e) {
        console.log(e)
      }
    }
  }
}
</script>
