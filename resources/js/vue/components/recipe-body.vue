<template>
  <div>
    <h2>Description:</h2>
    <p>{{ recipe.description }}</p>
    <h2>Ingredients:</h2>
    <div class="row">
      <div class="col-md-6">
        <div class="ingredients">
          <div
            class="ingredient"
            v-for="(ingredient,index) in ingredients "
            :key="index"
          >{{ ingredient.name }}</div>
        </div>
      </div>
      <div class="col-md-6">
        <ad-300-250></ad-300-250>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <h2>
          Process:
          <span>Step by step...</span>
        </h2>
        <div
          class="process"
          v-for="(step,index) in recipe.process.split('|') "
          :key="index"
        >{{ ++index }}. {{ step }}</div>
      </div>
      <div class="col-md-6">
        <ad-300-600></ad-300-600>
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-md-6 row">
        <div class="share">Share this recipe</div>
        <social-media></social-media>
      </div>
      <div class="col-md-6 row">
        <div class="save-text">Save this recipe to your list:</div>
        <div class="save-btn">Save</div>
      </div>
      <div class="col-md-6 row mg-tp-20">
        <div class="share">There is a problem in this page ?</div>
        <div class="edit-btn">Edit page</div>
      </div>
    </div>
    <hr />
    <div class="row">
      <h2 class="h2-key">Keywords:</h2>
      <div class="keyword" v-for="(kw,index) in keywords " :key="index">{{ kw.keyword }}</div>
    </div>
    <hr />
    <ad-728-90></ad-728-90>
    <br />
    <h2>You might also like:</h2>
    <most-loved :numberRecipes="6"></most-loved>
    <ad-728-90></ad-728-90>
  </div>
</template>
<script>
import Ad300_250 from './ads/ad-300-250'
import Ad300_600 from './ads/ad-300-600'
import Ad728_90 from './ads/ad-728-90'
import SocialMedia from './share-social-media'
import MostLovedRecipes from './most-loved-recipes'
export default {
  props: ['recipe'],
  components: {
    'ad-300-250': Ad300_250,
    'ad-300-600': Ad300_600,
    'ad-728-90': Ad728_90,
    'social-media': SocialMedia,
    'most-loved': MostLovedRecipes,
  },
  data: function () {
    return {
      ingredients: [],
      keywords: [],
      url: 'http://' + document.location.hostname + ':8000/api/recipe/'
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
    getIngredients() {
      var id = this.getRecipeId();
      axios.get(this.url + id + '/ingredients')
        .then(response => {
          this.ingredients = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
    getKeywords() {
      var id = this.getRecipeId();
      axios.get(this.url + id + '/keywords')
        .then(response => {
          this.keywords = response.data
        })
        .catch(error => {
          console.log(error);
        })
    }
  },
  created() {
    this.getIngredients();
    this.getKeywords();
  },

}
</script>
<style scoped>
.ingredient {
  display: inline-block;
  background-color: white;
  border-radius: 15px;
  margin-right: 5px;
  margin-top: 8px;
  padding: 5px 10px;
  border: 0.5px solid gray;
}
h2 span {
  font-size: 16px;
}
.process {
  font-size: 20px;
  margin-top: 20px;
}
.share,
.save-text {
  font-size: 20px;
  margin-left: 40px;
  margin-right: 40px;
  padding-top: 5px;
}
.save-btn {
  background-color: white;
  border-radius: 20px;
  border: 1px solid gray;
  height: 40px;
  width: 150px;
  font-size: 24px;
  font-weight: bold;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}
.edit-btn {
  background-color: #2c5d63;
  color: white;
  border-radius: 20px;
  border: 1px solid gray;
  height: 40px;
  width: 150px;
  font-size: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}
.mg-tp-20 {
  margin-top: 20px;
}
.keyword {
  display: inline-block;
  background-color: #283739;
  color: white;
  border-radius: 20px;
  margin-right: 5px;
  margin-top: 3px;
  padding: 5px 10px;
  border: 0.5px solid gray;
  height: 35px;
}
.h2-key {
  margin-right: 30px;
  margin-left: 15px;
}
</style>