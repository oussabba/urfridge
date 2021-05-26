<template>
  <div>
    <h1>Last added recipes:</h1>
    <div class="row">
      <div class="col-md-4">
        <recipe-card></recipe-card>
      </div>
      <div class="col-md-4">
        <recipe-card></recipe-card>
      </div>
      <div class="col-md-4">
        <recipe-card></recipe-card>
      </div>
      <div class="col-md-4">
        <recipe-card></recipe-card>
      </div>
      <div class="col-md-4">
        <recipe-card></recipe-card>
      </div>
      <div class="col-md-4">
        <recipe-card></recipe-card>
      </div>
    </div>
  </div>
</template>

<script>
import RecipeCard from './recipe-card.vue';
export default {
  components: {
    RecipeCard
  }
}
</script>

<style scoped>
h1 {
  margin-left: 10%;
}
</style>

