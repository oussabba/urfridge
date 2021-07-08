<template>
  <carousel :autoplay="true" :nav="false" :items="1" :autoplayTimeout="10000">
    <!-- <img src="/storage/img/books/family-meal.jpg" />
    <img src="/storage/img/books/family-meal.jpg" />
    <img src="/storage/img/books/family-meal.jpg" />-->
    <img
      v-for="(image,index) in images"
      :key="index"
      :src="'/storage/img/books/'+ image.url_image"
      :alt="'urfridge.com |'+ bookTitle"
    />
  </carousel>
</template>
<script>
import Carousel from 'vue-owl-carousel'
export default {
  props: ['images', 'bookTitle'],
  components: {
    Carousel,
  },
}
</script>
<style scoped>
</style>