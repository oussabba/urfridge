<template>
  <div class="container">
    <carousel-banner></carousel-banner>
    <search-recipes-by-ingredients></search-recipes-by-ingredients>
    <last-added-recipes></last-added-recipes>
    <h1>Most loved recipes:</h1>
    <most-loved-recipes :numberRecipes="8"></most-loved-recipes>
    <search-recipes></search-recipes>
  </div>
</template>

<script>
import CarouselBanner from '../carousel-banner.vue';
import LastAddedRecipes from '../last-added-recipes.vue';
import MostLovedRecipes from '../most-loved-recipes.vue';
import SearchRecipes from '../search-recipe.vue';
import SearchRecipesByIngredients from '../search-by-ingredient.vue';


export default {
  components: {
    CarouselBanner,
    LastAddedRecipes,
    MostLovedRecipes,
    SearchRecipes,
    SearchRecipesByIngredients
  },
};
</script>

<style scoped>
</style>