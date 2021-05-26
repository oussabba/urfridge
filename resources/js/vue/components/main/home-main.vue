<template>
  <div>
    <carousel-banner></carousel-banner>
    <last-added-recipes></last-added-recipes>
  </div>
</template>

<script>
import CarouselBanner from '../carousel-banner.vue';
import LastAddedRecipes from '../last-added-recipes.vue';

export default {
  components: {
    CarouselBanner,
    LastAddedRecipes
  },
};
</script>