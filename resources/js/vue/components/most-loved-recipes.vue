<template>
  <div class="most-loved-recipes">
    <div class="row">
      <div v-for="(recipe,index) in sortedRecipesByLove " :key="index" class="col">
        <recipe-card :recipe="recipe"></recipe-card>
      </div>
    </div>
  </div>
</template>
<script>
import RecipeCard from './recipe-card.vue';
export default {
  props: ['numberRecipes'],
  components: {
    RecipeCard
  },
  data: function () {
    return {
      sortedRecipesByLove: [],
      url: 'http://' + document.location.hostname + ':8000/api/sortedRecipes/' + this.numberRecipes
    }
  },
  methods: {
    getSortedRecipes() {
      axios.get(this.url)
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
  margin-top: 20px;
}
</style>