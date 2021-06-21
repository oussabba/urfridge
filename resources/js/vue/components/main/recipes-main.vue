<template>
  <div class="container">
    <ad-720-300></ad-720-300>
    <div class="row">
      <label for="sort">Sort by:</label>
      <select
        class="form-control sort"
        name="sort"
        id="sort"
        @change="getRecipes($event)"
        v-model="selectedSort"
      >
        <option value="date" selected>Date</option>
        <option value="loves">Number of loves</option>
        <option value="time">Preparation time</option>
        <option value="ingredients">Number of ingredients</option>
      </select>
    </div>
    <div class="row">
      <div v-for="(recipe,index) in recipes " :key="index" class="recipe col-12">
        <div class="row">
          <div class="col-md-4 img-recipe">
            <img
              :src="'/storage/img/recipes/'+ recipe.image_url"
              :alt="'urfridge.com | '+ recipe.title"
            />
          </div>
          <div class="recipe-body col-md-8">
            <div class="row">
              <div class="col-11">
                <a :href="hostName + recipe.id + '/' + seoFriendlyTitle(recipe.title)">
                  <h4>{{ recipe.title }}</h4>
                </a>
              </div>
              <div class="col-1">
                <font-awesome-icon icon="heart" class="loved-btn" />
              </div>
            </div>
            <div class="recipe-desc">{{ recipe.description | subStr}}</div>
            <div class="recipe-footer">
              <div class="row">
                <div class="col-3 loves">
                  {{ recipe.number_loves }}&nbsp;
                  <font-awesome-icon icon="heart" class="heart" />&nbsp;this
                </div>
                <div class="col-3 loves">
                  Total time: &nbsp;
                  {{ recipe.total_time }} min
                </div>
                <div class="col-3 loves">
                  Ingredients: &nbsp;
                  {{ recipe.nmbre_ingredients }}
                </div>
                <div class="col-3">
                  <a :href="hostName + recipe.id + '/' + seoFriendlyTitle(recipe.title)">
                    <div class="checkout-btn">Check out</div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <ad-728-90 v-if="index%2==0 && index!=0"></ad-728-90>
      </div>
    </div>
  </div>
</template>
<script>
import Ad720_300 from '../ads/ad-720-300'
import Ad728_90 from '../ads/ad-728-90'

export default {
  components: {
    'ad-720-300': Ad720_300,
    'ad-728-90': Ad728_90
  },
  data: function () {
    return {
      recipes: [],
      selectedSort: [],
      url: 'http://' + document.location.hostname + ':8000/api/recipes/all?sort=',
      hostName: 'http://127.0.0.1:8000/recipe/'
    }
  },
  methods: {
    getRecipes(e) {
      let sort = e.target.value
      axios.get(this.url + sort)
        .then(response => {
          this.recipes = response.data
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
    }
  },
  filters: {
    subStr: function (string) {
      return string.substring(0, 300) + '...';
    },

  }
}
</script>
<style scoped>
.sort {
  border-radius: 15px;
  margin-left: 15px;
  width: 200px;
  margin-top: -7px;
}
.recipe {
  margin-top: 15px;
  border-radius: 15px;
  width: 100%;
}
.recipe-body {
  background-color: white;
  width: 100%;
  height: 280px;
  padding: 20px;
  border-radius: 0 20px 20px 0;
}
img {
  width: 100%;
  height: 280px;
  border-radius: 20px 0 0 20px;
}
.loved-btn {
  color: gray;
  font-size: 27px;
  text-shadow: 2px 2px #ff0000;
  cursor: pointer;
}
.loved-btn:hover {
  color: red;
}
.img-recipe {
  padding: 0px;
}
.recipe-footer {
  text-align: center;
  font-size: 18px;
  margin-top: 150px;
}
.checkout-btn {
  background-color: #2c5d63;
  color: white;
  height: 40px;
  width: 150px;
  margin: 0px auto;
  border-radius: 30px;
  text-align: center;
  font-size: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}
.heart {
  color: red;
}
.loves {
  padding-top: 10px;
}
a {
  text-decoration: none;
  color: #283739;
}
</style>