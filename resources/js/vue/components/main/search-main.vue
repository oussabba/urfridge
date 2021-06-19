<template>
  <div class="container">
    <ad-720-300></ad-720-300>
    <search-recipe class="mg-bt-50"></search-recipe>
  </div>
</template>
<script>
import SearchRecipe from '../search-recipe'
import Ad720_300 from '../ads/ad-720-300'
export default {
  components: {
    'ad-720-300': Ad720_300,
    'search-recipe': SearchRecipe,
  }
}
</script>
<style scoped>
.mg-bt-50 {
  margin-bottom: 50px;
}
</style>
