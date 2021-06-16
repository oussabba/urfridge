<template>
  <div class="container">
    <recipe-infos :recipe="recipe"></recipe-infos>
  </div>
</template>

<script>
import RecipeInfos from '../recipe-infos.vue';

export default {
  components: {
    RecipeInfos,
  },
  data: function () {
    return {
      recipe: {}
    }
  },
  methods: {
    getRecipeId() {
      var url = window.location.href;
      return url.substring(
        url.lastIndexOf("/recipe") + 8,
        url.lastIndexOf("/")
      );
    },
    getRecipe() {
      var id = this.getRecipeId();
      axios.get('http://' + document.location.hostname + ':8000/api/recipe/' + id)
        .then(response => {
          this.recipe = response.data
        })
        .catch(error => {
          console.log(error);
        })
      // console.log(this.recipe.title);
    }
  },
  created() {
    this.getRecipe();
  }
}
</script>

<style scoped>
</style>