<template>
  <div class="flex-1">
    <label for="file" class="flex flex-col items-center justify-center cursor-pointer">
      <i class="mdi mdi-youtube text-6xl text-main"></i>
      <h3 class="text-text" v-text="message"></h3>
    </label>

    <input type="file" name="file" id="file" class="hidden" @change="upload" />
  </div>
</template>

<script>
export default {
  props: ['url'],

  data() {
    return {
      message: 'Faça o upload do video aqui!'
    }
  },

  methods: {
    async upload(evt) {
      this.message = 'Enviando...'
      try {
        let form = new FormData()
        form.append('video', evt.target.files[0]);
        const response = await axios.post(this.url, form, {
          headers: {
            'Content-Type': 'multipart/form-data'
          },
          onUploadProgress: progressEvent => this.$emit('progress', Math.round((progressEvent.loaded * 100) / progressEvent.total))
        })
        this.$emit('complete', response.data.video_path)
        this.message = 'Seu video foi enviado com sucesso!'
      } catch (e) {
        console.log(e)
      }
    }
  }
}
</script>
