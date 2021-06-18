<template>
  <div class="container">
    <recipe-infos :recipe="recipe"></recipe-infos>
    <ad-720-300></ad-720-300>
    <recipe-body :recipe="recipe"></recipe-body>
    <comments-section></comments-section>
  </div>
</template>

<script>
import RecipeInfos from '../recipe-infos'
import RecipeBody from '../recipe-body'
import RecipeComments from '../recipe-comments'
import Ad720_300 from '../ads/ad-720-300.vue'

export default {
  components: {
    RecipeInfos,
    'recipe-body': RecipeBody,
    'comments-section': RecipeComments,
    'ad-720-300': Ad720_300
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