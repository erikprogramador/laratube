<template>
  <form>
    <header>
      <input type="text" name="title" id="title" placeholder="Título do video" />
    </header>

    <div class="flex -mx-4">
      <div class="w-1/3">
        <i class="mdi mdi-home"></i>
      </div>
      <div class="w-2/3">
        <!-- Description -->
        <!-- tags -->
        <!-- status (publicado, não publicado) -->
        <!-- visibilidade (publico, privado, apenas para link) -->
        <!-- data de publicacao -->
      </div>
    </div>

    <footer class="text-right">
      <button type="button" @click.prevent="$emit('close')">Cancelar</button>
      <button>Salvar</button>
    </footer>
  </form>
</template>

<script>
export default {
  //
}
</script>
