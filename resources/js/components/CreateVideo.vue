<template>
  <form class="flex flex-col h-full" @submit.prevent="store">
    <header>
      <input
        type="text"
        name="title"
        id="title"
        placeholder="Título do video"
        class="bg-default outline-none px-2 py-4 w-full"
        v-model="form.title"
      />
    </header>

    <div class="flex -mx-4 px-4 flex-1 overflow-y-auto">
      <div class="w-1/3 mx-4 flex flex-col">
        <dropzone
          @complete="path => form.video_file = path"
          :url="`/videos/${channel.slug}/upload`"
          @progress="percentage => uploadProgress = percentage"
        />

        <progress-bar :progress="uploadProgress"></progress-bar>
      </div>

      <div class="w-2/3 mx-4">
        <ul class="border border-link p-2 rounded" v-if="errors.length">
          <li
            class="text-link text-sm"
            v-for="(error, index) in errors"
            :key="index"
            v-text="error"
          ></li>
        </ul>

        <!-- Description -->
        <div class="block my-4">
          <label class="block font-semibold text-sm mb-2" for="description">Descrição</label>
          <textarea
            name="description"
            id="description"
            placeholder="Descrição"
            class="resize-none border border-side-focus w-full h-32 outline-none p-2 rounded"
            v-model="form.description"
          ></textarea>
        </div>

        <!-- tags -->
        <div class="block my-4">
          <label class="block font-semibold text-sm mb-2" for="tags">Tags</label>

          <vue-tags-input
            v-model="tag"
            :tags="form.tags"
            @tags-changed="newTags => form.tags = newTags"
            placeholder="Adicionar tag"
          />
        </div>

        <!-- @TODO: data de publicacao -->

        <div class="flex items-center my-4 -mx-4">
          <!-- status (publicado, não publicado) -->
          <div class="inline-block mx-4 w-1/2">
            <label class="block font-semibold text-sm mb-2" for="status">Satatus</label>

            <select
              name="status"
              id="status"
              class="bg-default rounded p-2 outline-none border border-side-focus appearance-none w-full"
              v-model="form.status"
            >
              <option value="0">Não publicado</option>
              <option value="1">Publicado</option>
            </select>
          </div>

          <!-- visibilidade (publico, privado, apenas para link) -->
          <div class="inline-block mx-4 w-1/2">
            <label class="block font-semibold text-sm mb-2" for="visibility">Visibilidade</label>

            <select
              name="visibility"
              id="visibility"
              class="bg-default rounded p-2 outline-none border border-side-focus appearance-none w-full"
              v-model="form.visibility"
            >
              <option value="1">Publico</option>
              <option value="2">Privado</option>
              <option value="3">Apenas compartilhado</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <footer class="text-right py-2 px-2">
      <button
        class="py-2 px-5 bg-side text-text rounded font-semibold text-sm uppercase mr-2"
        type="button"
        @click.prevent="close"
      >Cancelar</button>

      <button class="py-2 px-5 bg-main text-default rounded font-semibold text-sm uppercase">Salvar</button>
    </footer>
  </form>
</template>

<script>
import VueTagsInput from '@johmun/vue-tags-input';

export default {
  props: ['channel'],

  components: {
    VueTagsInput,
  },

  data() {
    return {
      uploadProgress: 0,
      tag: '',
      form: {
        title: '',
        description: '',
        tags: [],
        status: 0,
        visibility: 1,
        video_file: null,
        thumb_file: '/videos/thumb/default.png',
      },
      errors: []
    };
  },

  methods: {
    close() {
      this.$emit('close')
      this.reset()
    },

    reset() {
      this.form = {
        title: '',
        description: '',
        tags: [],
        status: 0,
        visibility: 1,
        video_file: null,
        thumb_file: '/videos/thumb/default.png',
      }
    },

    async store() {
      let form = JSON.parse(JSON.stringify(this.form))
      form.tags = form.tags.map(tag => tag.text)

      try {
        const response = await axios.post(`/videos/${this.channel.slug}`, form)
        alert('Video criado com sucesso!')
        this.reset()
      } catch (e) {
        const errors = Object.keys(e.response.data.errors).map((error) => e.response.data.errors[error])
        this.errors = this.flatten(errors)
      }
    },

    flatten(arr) {
      return Array.prototype.concat.apply([], arr)
    }
  }
}
</script>

<style>
.vue-tags-input {
  max-width: 100% !important;
  width: 100%;
}

.vue-tags-input .ti-input {
  border-radius: 0.25rem;
}
</style>

