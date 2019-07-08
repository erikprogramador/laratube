<template>
  <form class="flex flex-col h-full">
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
        <label for="file" class="flex-1 flex flex-col items-center justify-center cursor-pointer">
          <i class="mdi mdi-youtube text-6xl text-main"></i>
          <h3 class="text-text">Faça o upload do video aqui!</h3>
        </label>

        <input type="file" name="file" id="file" class="hidden" />

        <progress-bar :progress="uploadProgress"></progress-bar>
      </div>

      <div class="w-2/3 mx-4">
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
  components: {
    VueTagsInput,
  },

  data() {
    return {
      uploadProgress: 80,
      tag: '',
      form: {
        name: '',
        description: '',
        tags: [],
        status: 0,
        visibility: 1
      }
    };
  },

  methods: {
    close() {
      this.$emit('close')
      this.reset()
    },

    reset() {
      this.form = {
        name: '',
        description: '',
        tags: [],
        status: 0,
        visibility: 1
      }
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

