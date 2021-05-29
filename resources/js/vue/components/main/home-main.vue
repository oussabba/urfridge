<template>
  <div class="container">
    <carousel-banner></carousel-banner>
    <last-added-recipes></last-added-recipes>
    <most-loved-recipes></most-loved-recipes>
  </div>
</template>

<script>
import CarouselBanner from '../carousel-banner.vue';
import LastAddedRecipes from '../last-added-recipes.vue';
import MostLovedRecipes from '../most-loved-recipes.vue';

export default {
  components: {
    CarouselBanner,
    LastAddedRecipes,
    MostLovedRecipes
  },
};
</script>

<style scoped>
</style>