<template>
  <div class="most-loved-recipes">
    <h1>Most loved recipes:</h1>
    <div class="row">
      <div
        v-for="(recipe,index) in sortedRecipesByLove "
        :key="index"
        class="col-12 col-sm-6 col-md-3"
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
      sortedRecipesByLove: []
    }
  },
  methods: {
    getSortedRecipes() {
      axios.get('api/sortedRecipes/8')
        .then(response => {
          this.sortedRecipesByLove = response.data
        })
        .catch(error => {
          console.log(error);
        })
    }
  },
  created() {
    this.getSortedRecipes();
  }
}
</script>

<style scoped>
.most-loved-recipes {
  margin-top: 30px;
}
</style>