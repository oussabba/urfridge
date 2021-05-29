<template>
  <div>
    <h1>Last added recipes:</h1>
    <div class="row">
      <div
        v-for="(recipe,index) in lastAddedRecipes "
        :key="index"
        class="col-12 col-sm-6 col-md-4"
      >
        <recipe-card :recipe="recipe"></recipe-card>
      </div>
    </div>
  </div>
</template>

<script>
import RecipeCard from './recipe-card.vue';
export default {
  components: {
    RecipeCard
  },
  data: function () {
    return {
      lastAddedRecipes: []
    }
  },
  methods: {
    getLastAddedRecipes() {
      axios.get('api/recipes/6')
        .then(response => {
          this.lastAddedRecipes = response.data
        })
        .catch(error => {
          console.log(error);
        })
    }
  },
  created() {
    this.getLastAddedRecipes();
  }
}
</script>

<style scoped>
h1 {
  margin-left: 10%;
}
</style>

