<template>
  <div class="container">
    <ad-720-300></ad-720-300>
    <div class="row">
      <div class="search-box">
        <div class="row">
          <div class="col-md-5">
            <h3>Looking for a specific recipe?</h3>
          </div>
          <div class="col-md-5">
            <input type="text" name="search-q" id="search-q" class="form-control search-input" />
          </div>
          <div class="col-md-2">
            <div class="search-btn">Find</div>
          </div>
        </div>
      </div>
    </div>
    <br />
    <div class="row">
      <div class="ingredients">
        <div
          class="ingredient"
          v-for="(ingredient,index) in ingredients "
          :key="index"
        >{{ ingredient.name }}</div>
      </div>
    </div>
    <div class="row margin-tp-50">
      <div class="col-md-4" v-for="(recipe,index) in recipes" :key="index">
        <a :href="hostName + recipe.id + '/' + seoFriendlyTitle(recipe.title)">
          <div class="recipe-image">
            <img
              :src="'/storage/img/recipes/'+ recipe.image_url"
              :alt="'urfridge.com | '+ recipe.title"
            />
            <div class="recipe-time">{{ recipe.total_time }}min</div>
          </div>
        </a>
        <a :href="hostName + recipe.id + '/' + seoFriendlyTitle(recipe.title)">
          <div class="recipe-title">{{ recipe.title }}</div>
        </a>
        <div class="ingredients row">
          <div
            class="ingredient"
            v-for="(ingredient,index) in ingredients "
            :key="index"
          >{{ ingredient.name }}</div>
          <div class="more-ingredients">+ {{ recipe.number_ingredients - ingredients.length }} more</div>
        </div>
      </div>
      <!-- <div class="col-md-4">
        <ad-300-250 v-if="recipes.length % 1 == 0"></ad-300-250>
      </div>-->
    </div>
  </div>
</template>
<script>
import Ad720_300 from '../ads/ad-720-300'
import Ad300_250 from '../ads/ad-300-250'


export default {
  components: {
    'ad-720-300': Ad720_300,
    'ad-300-250': Ad300_250,
  },
  data: function () {
    return {
      url: 'http://' + document.location.hostname + ':8000/api/',
      ingredients: [],
      recipes: [],
      hostName: 'http://127.0.0.1:8000/recipe/'
    }
  },
  methods: {
    getUrlParam() {
      var sURL = window.document.URL.toString();
      var value = [];
      if (sURL.indexOf("?") > 0) {
        var arrParams = sURL.split("?");
        var arrURLParams = arrParams[1].split("&");
        for (var i = 0; i < arrURLParams.length; i++) {
          var sParam = arrURLParams[i].split("=");
          if (sParam) {
            if (sParam[0] == "i[]") {
              if (sParam.length > 0) {
                value.push(sParam[1].trim())
                this.getIngredientLabel(sParam[1].trim());
              }
            }
          }
        }
      }
      console.log(value.toString());
    },
    getIngredientLabel(id) {
      axios.get(this.url + 'ingredient/' + id + '/name')
        .then(response => {
          this.ingredients.push(response.data[0]);
        })
        .catch(error => {
          console.log(error);
        })
    },
    getRecipesByingredients() {
      axios.get(this.url + 'search/recipes' + window.location.search)
        .then(response => {
          this.recipes = response.data;
        })
        .catch(error => {
          console.log(error);
        })
    },
    seoFriendlyTitle(title) {
      return title.toString()               // Convert to string
        .normalize('NFD')               // Change diacritics
        .replace(/[\u0300-\u036f]/g, '') // Remove illegal characters
        .replace(/\s+/g, '-')            // Change whitespace to dashes
        .toLowerCase()                  // Change to lowercase
        .replace(/&/g, '-and-')          // Replace ampersand
        .replace(/[^a-z0-9\-]/g, '')     // Remove anything that is not a letter, number or dash
        .replace(/-+/g, '-')             // Remove duplicate dashes
        .replace(/^-*/, '')              // Remove starting dashes
        .replace(/-*$/, '');
    },
  },
  filters: {
    subStr: function (string) {
      return string.substring(0, 300) + '...';
    },
  },
  created() {
    this.getUrlParam();
    this.getRecipesByingredients();
  }
}
</script>
<style scoped>
.search-input {
  border-radius: 15px;
}
.search-box {
  width: 100%;
  border: 2px solid #283739;
  border-radius: 15px;
  padding: 30px;
}
.search-btn {
  background-color: #2c5d63;
  color: white;
  height: 38px;
  width: 100%;
  border-radius: 30px;
  text-align: center;
  font-size: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}
.ingredient {
  display: inline-block;
  background-color: #283739;
  color: white;
  border-radius: 20px;
  margin-right: 5px;
  margin-top: 8px;
  padding: 5px 10px;
  border: 0.5px solid gray;
}
img {
  width: 100%;
  height: 270px;
  border-radius: 20px;
}
.recipe-image {
  position: relative;
}
.margin-tp-50 {
  margin-top: 50px;
}
.recipe-title {
  text-align: center;
  font-size: 20px;
}
.recipe-time {
  position: absolute;
  bottom: 10px;
  right: 10px;
  background-color: white;
  opacity: 0.8;
  border-radius: 15px;
  padding: 5px 20px;
}
.more-ingredients {
  display: inline-block;
  background-color: white;
  border-radius: 20px;
  margin-right: 5px;
  margin-top: 8px;
  padding: 5px 10px;
  border: 0.5px solid gray;
}
a {
  color: black;
  text-decoration: none;
}
</style>