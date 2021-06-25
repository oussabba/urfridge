<template>
  <div class="container">
    <div class="row">
      <div class="col-7">
        <h1 class="welcome">Welcome {{ user.name }}!</h1>
      </div>
      <div class="col-5">
        <div class="balance">
          FridgeCoins balance:
          <span>{{ user.balance }}</span>
        </div>
      </div>
    </div>
    <ad-720-300></ad-720-300>
    <h1>Here is your saved saved recipes:</h1>
    <div class="row">
      <div v-for="(recipe,index) in savedRecipes.slice(0, 4) " :key="index" class="col-md-3">
        <recipe-card :recipe="recipe"></recipe-card>
      </div>
    </div>
    <ad-728-90 v-if="savedRecipes.length>=4"></ad-728-90>
    <div class="row">
      <div v-for="(recipe,index) in savedRecipes.slice(4, 8) " :key="index" class="col-md-3">
        <recipe-card :recipe="recipe"></recipe-card>
      </div>
    </div>
    <ad-728-90 v-if="savedRecipes.length>=8"></ad-728-90>
    <div class="row">
      <div v-for="(recipe,index) in savedRecipes.slice(8, 12) " :key="index" class="col-md-3">
        <recipe-card :recipe="recipe"></recipe-card>
      </div>
    </div>
    <div class="see-all-btn">See all</div>
    <ad-720-300></ad-720-300>
    <h1>You loved this recipes:</h1>
    <div class="row">
      <div class="col-md-8">
        <div v-for="(recipe,index) in lovedRecipes" :key="index" class="row loved-recipe">
          <div class="col-10">
            <div class="row">
              <div class="col-4 loved-recipe-image">
                <img
                  :src="'/storage/img/recipes/'+ recipe.image_url"
                  :alt="'urfridge.com | '+ recipe.title"
                />
              </div>
              <div class="col-8 loved-recipe-body">
                <div class="loved-recipe-title">{{ recipe.title }}</div>
                <div class="loved-recipe-description">{{ recipe.description|subStr }}</div>
              </div>
            </div>
          </div>
          <div class="col-2">
            <font-awesome-icon icon="heart" class="loved-btn" />
          </div>
        </div>
        <div class="see-more-btn">More...</div>
      </div>
      <div class="col-md-4">
        <ad-160-600></ad-160-600>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <h1>Share your recipes:</h1>
        <h5>You can earn fridgeCoins by sharing your own recipes…</h5>
      </div>
      <div class="col-md-4">
        <div @click="showRecipeForm()" class="add-recipe-btn">Add recipe +</div>
      </div>
    </div>
    <add-recipe-form id="recipe-form"></add-recipe-form>
    <br />
    <div class="row">
      <div class="col-12">
        <h1>Royal recipes:</h1>
        <h5>You can use FridgeCoins to buy premium recipes…</h5>
      </div>
    </div>
    <div class="row">
      <div v-for="(recipe,index) in royalRecipes.slice(0, 3)" :key="index" class="col-md-4">
        <royal-recipe-card :recipe="recipe"></royal-recipe-card>
        <!-- <div class="recipe-price">{{ getRoyalRecipePrice(recipe.id) }}</div> -->
        <div class="recipe-price">{{ royalRecipePrice[index] }}</div>
      </div>
    </div>
    <ad-728-90 v-if="royalRecipes.length>=3"></ad-728-90>
    <div class="row">
      <div v-for="(recipe,index) in royalRecipes.slice(3, 6)" :key="index" class="col-md-4">
        <royal-recipe-card :recipe="recipe"></royal-recipe-card>
        <!-- <div class="recipe-price">{{ getRoyalRecipePrice(recipe.id) }}</div> -->
        <div class="recipe-price">{{ royalRecipePrice[index] }}</div>
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
import Ad160_600 from '../ads/ad-160-600'
import RecipeCard from '../saved-recipe-card'
import AddRecipeForm from '../add-recipe-form'
import RoyalRecipeCard from '../royal-recipe-card'


export default {
  components: {
    'ad-720-300': Ad720_300,
    'ad-728-90': Ad728_90,
    'ad-160-600': Ad160_600,
    'recipe-card': RecipeCard,
    'royal-recipe-card': RoyalRecipeCard,
    'add-recipe-form': AddRecipeForm,
  },
  data: function () {
    return {
      user: {},
      counter: 0,
      savedRecipes: [],
      lovedRecipes: [],
      royalRecipes: [],
      royalRecipePrice: ['20 ufc', '50 ufc', '60 ufc', '200 ufc', '150 ufc', '100 ufc'],
      url: 'http://' + document.location.hostname + ':8000/api/',
    }
  },
  methods: {
    getUserId() {
      var url = window.location.href;
      return url.substring(
        url.lastIndexOf("/dashboard") + 11
      );
    },
    getUser() {
      var id = this.getUserId();
      axios.get(this.url + 'user/' + id)
        .then(response => {
          this.user = response.data[0]
        })
        .catch(error => {
          console.log(error);
        })
    },
    getSavedRecipes() {
      var id = this.getUserId();
      axios.get(this.url + 'user/' + id + '/recipes/saved')
        .then(response => {
          this.savedRecipes = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
    getLovedRecipes() {
      var id = this.getUserId();
      axios.get(this.url + 'user/' + id + '/recipes/loved')
        .then(response => {
          this.lovedRecipes = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
    getRoyalRecipes() {
      axios.get(this.url + 'royal-recipes?l=6')
        .then(response => {
          this.royalRecipes = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
    getRoyalRecipePrice(id) {
      axios.get(this.url + 'royal-recipes/' + id + '/price')
        .then(response => {
          console.log(response.data[0].price)
          return response.data[0].price
        })
        .catch(error => {
          console.log(error);
        })
    },
    showRecipeForm() {
      document.getElementById("recipe-form").style.display = 'block';
    },
  },
  filters: {
    subStr: function (string) {
      return string.substring(0, 60) + '...';
    },
  },
  created() {
    this.getUser();
    this.getSavedRecipes();
    this.getLovedRecipes();
    this.getRoyalRecipes();
  },
}
</script>
<style scoped>
.welcome {
  margin-top: 30px;
}
.balance {
  margin-top: 40px;
  position: absolute;
  right: 10px;
}
.balance span {
  background-color: #283739;
  border-radius: 15px;
  color: white;
  padding: 0 30px 0 30px;
  margin-left: 30px;
}
.see-all-btn {
  background-color: #2c5d63;
  color: white;
  height: 60px;
  width: 200px;
  margin: 20px auto;
  border-radius: 30px;
  text-align: center;
  font-size: 22px;
  font-weight: bold;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}
.loved-recipe {
  height: 60px;
  width: 100%;
  margin-top: 8px;
}
.loved-recipe img {
  height: 60px;
  width: 100%;
  border-radius: 20px 0px 0px 20px;
  border: 1px solid gray;
}
.loved-recipe-body {
  background-color: white;
  margin: 0;
  border-radius: 0px 20px 20px 0;
  border: 1px solid gray;
}
.loved-recipe-image {
  margin: 0;
  padding: 0;
}
.loved-recipe-title {
  font-weight: bold;
}
.loved-btn {
  color: red;
  font-size: 27px;
  text-shadow: 2px 2px #ff0000;
  cursor: pointer;
  font-size: 38px;
  margin-top: 13px;
}
.loved-btn:hover {
  color: white;
}
.see-more-btn {
  background-color: #2c5d63;
  color: white;
  height: 45px;
  width: 150px;
  margin: 20px auto;
  border-radius: 30px;
  text-align: center;
  font-size: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}
.add-recipe-btn {
  background-color: #2c5d63;
  color: white;
  height: 60px;
  width: 200px;
  margin: 20px auto;
  border-radius: 30px;
  text-align: center;
  font-size: 22px;
  font-weight: bold;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}
#recipe-form {
  display: none;
}
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
.recipe-price {
  background-color: white;
  border-radius: 15px;
  border: 1px solid gray;
  width: 120px;
  height: 30px;
  padding-top: 4px;
  text-align: center;
  margin: 20px auto;
}
</style>