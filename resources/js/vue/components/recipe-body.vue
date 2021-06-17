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
  </div>
</template>
<script>
import Ad300_250 from './ads/ad-300-250'
import Ad300_600 from './ads/ad-300-600'
export default {
  props: ['recipe'],
  components: {
    'ad-300-250': Ad300_250,
    'ad-300-600': Ad300_600,
  },
  data: function () {
    return {
      ingredients: [],
      counter: 0
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
      axios.get('http://' + document.location.hostname + ':8000/api/recipe/' + id + '/ingredients')
        .then(response => {
          this.ingredients = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
    // getProcesses() {
    //   var process = this.recipe.process;
    //   process.substring(
    //     process.lastIndexOf("/recipe") + 8,
    //     process.lastIndexOf("/")
    //   );
    // }
  },
  // updated() {
  //   this.thisRecipe = this.recipe;
  // },
  created() {
    this.getIngredients();
    // this.processes = this.thisRecipe.process.split('|');
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
}
</style>