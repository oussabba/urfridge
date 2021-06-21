<template>
  <div class="container">
    <ad-720-300></ad-720-300>
    <h1>Last added recipes:</h1>
    <div class="row">
      <div v-for="(recipe,index) in lastAddedRecipes" :key="index" class="col-md-4">
        <recipe-card :recipe="recipe"></recipe-card>
      </div>
    </div>
    <ad-728-90></ad-728-90>
    <h1>Most loved recipes:</h1>
    <div class="row">
      <div class="col-md-7">
        <div class="row">
          <div v-for="(recipe,index) in mostLovedRecipes" :key="index" class="col-md-6">
            <recipe-card :recipe="recipe"></recipe-card>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <ad-300-600></ad-300-600>
      </div>
    </div>
    <br />
    <h1>Royal recipes:</h1>
    <div class="row">
      <div v-for="(recipe,index) in royalRecipes" :key="index" class="col-md-3">
        <royal-recipe-card :recipe="recipe"></royal-recipe-card>
      </div>
    </div>
    <div class="row">
      <div class="see-more-royal-btn">See more &#128081; recipes</div>
    </div>
  </div>
</template>
<script>
import Ad720_300 from '../ads/ad-720-300'
import Ad728_90 from '../ads/ad-728-90'
import Ad300_600 from '../ads/ad-300-600'
import RecipeCard from '../recipe-card'
import RoyalRecipeCard from '../royal-recipe-card'

export default {
  components: {
    'ad-720-300': Ad720_300,
    'ad-728-90': Ad728_90,
    'ad-300-600': Ad300_600,
    'recipe-card': RecipeCard,
    'royal-recipe-card': RoyalRecipeCard
  },
  data: function () {
    return {
      lastAddedRecipes: [],
      mostLovedRecipes: [],
      royalRecipes: [],
      lastAddedUrl: 'http://' + document.location.hostname + ':8000/api/recipes/6',
      mostLovedUrl: 'http://' + document.location.hostname + ':8000/api/sortedRecipes/6',
      royalUrl: 'http://' + document.location.hostname + ':8000/api/royal-recipes?l=8'
    }
  },
  methods: {
    getLastAddedRecipes() {
      axios.get(this.lastAddedUrl)
        .then(response => {
          this.lastAddedRecipes = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
    getMostLovedRecipes() {
      axios.get(this.mostLovedUrl)
        .then(response => {
          this.mostLovedRecipes = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
    getRoyalRecipes() {
      axios.get(this.royalUrl)
        .then(response => {
          this.royalRecipes = response.data
        })
        .catch(error => {
          console.log(error);
        })
    }
  },
  created() {
    this.getLastAddedRecipes();
    this.getMostLovedRecipes();
    this.getRoyalRecipes();
  }
}
</script>
<style scoped>
.see-more-royal-btn {
  background-color: #2c5d63;
  color: white;
  border-radius: 30px;
  height: 50px;
  width: 200px;
  margin: 30px auto;
  font-size: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}
</style>