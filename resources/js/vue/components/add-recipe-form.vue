<template>
  <div class="recipe-form row">
    <center>
      <u>
        <h4>Propose a recipe:</h4>
      </u>
    </center>
    <div class="row">
      <div class="col-md-6">
        <h5>Choose needed ingredients:</h5>
        <select
          class="ingredients-categorie form-control"
          name="categorie"
          id="categorie"
          @change="getIngredientsByCategorie($event)"
          v-model="selectedCategorie"
        >
          <option value disabled selected>Categorie ?</option>
          <option
            v-for="(categorie,index) in categories "
            :key="index"
            :value="categorie.id_categorie"
          >{{ categorie.categorie_label }}</option>
        </select>
        <div class="row ingredients">
          <div class="col-6" v-for="(ingredient,index) in ingredients " :key="index">
            <div class="ing" @click="addToSelectedList(ingredient)">
              <img
                :src="'/assets/img/icons/'+ ingredient.icon"
                :alt="'urfridge.com | '+ingredient.name"
              />
              {{ ingredient.name }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="needed-ing-list">
          <div class="row">
            <div class="col-6" v-for="(selectedItem,index) in selectedIngredients " :key="index">
              <div class="selected-ingredient">-{{selectedItem.name}}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <ad-728-90></ad-728-90>
    <div class="row line">
      <h5>Preparation steps:</h5>
      <div @click="addNewStep()" id="add-step-btn">Add a step</div>
    </div>
    <div id="steps-container" class="row"></div>
    <div class="row line">
      <h5>Estimated time to prepare this recipe:</h5>
      <input type="number" name="time-needed" id="time" class="form-control needed-time" />
    </div>
    <div class="row line">
      <h5>Give a title to your dish:</h5>
    </div>
    <input type="text" name="title" id="title" class="form-control recipe-title" />
    <div class="row line">
      <h5>A little description may help:</h5>
    </div>
    <textarea name="description" id="discription" cols="122" rows="5"></textarea>
    <div class="row line">
      <h5>Add picture to your recipe:</h5>
      <input type="file" name="image" id="image" class="form-control recipe-img" />
    </div>
    <div class="submit-recipe-btn">Add</div>
  </div>
</template>
<script>
import Ad728_90 from './ads/ad-728-90'

export default {
  components: {
    'ad-728-90': Ad728_90,
  },
  data: function () {
    return {
      categories: [],
      ingredients: [],
      selectedCategorie: [],
      selectedIngredients: [],
      stepsCounter: 0,
      url: 'http://' + document.location.hostname + ':8000/api/',
    }
  },
  methods: {
    getCategories() {
      axios.get(this.url + 'ing-categories')
        .then(response => {
          this.categories = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
    getIngredientsByCategorie(e) {
      let categorie = e.target.value
      axios.get(this.url + 'ingredients?cat=' + categorie)
        .then(response => {
          this.ingredients = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
    addToSelectedList(ingredient) {
      let existed = false;
      this.selectedIngredients.forEach(item => {
        if (item.id_ingredient == ingredient.id_ingredient) {
          existed = true;
        }
      });
      if (!existed) {
        this.selectedIngredients.push(ingredient);
      }
    },
    addNewStep() {
      this.stepsCounter++;
      $("#steps-container").append('<div class="col-1" style="text-align:center;font-size:20px;padding-top:8px;">' + this.stepsCounter + '.</div><div  class="col-11"><input type="text" name="step" id="step" class="step-input form-control" style="width: 100%;border-radius: 20px;margin-top:5px" />');
    },
  },
  created() {
    this.getCategories();
    // this.getIngredientsByCategorie(1);
  }
}
</script>
<style scoped>
.recipe-form {
  width: 100%;
  background-color: #283739;
  color: white;
  border-radius: 20px;
  padding: 50px;
  margin-top: 20px;
  display: none;
}
.ingredients-categorie {
  width: 60%;
  height: 50px;
  border-radius: 20px;
  background-color: #2c5d63;
  color: white;
  text-align: center;
  margin: 50px auto;
}
.ingredients {
  width: 70%;
  margin: auto auto;
}
img {
  width: 30px;
  height: 30px;
}
.needed-ing-list {
  position: relative;
  background-image: url("/assets/img/notepad.png");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  width: 100%;
  min-height: 600px;
  padding-top: 180px;
  padding-right: 40px;
  padding-left: 100px;
}
.ing {
  background-color: white;
  color: black;
  border-radius: 20px;
  margin-right: 10px;
  margin-top: 5px;
  height: 40px;
  text-align: center;
  padding-top: 8px;
  cursor: pointer;
}
.selected-ingredient {
  font-size: 20px;
  color: black;
  /* text-align: center; */
}
#add-step-btn {
  background-color: white;
  color: black;
  height: 30px;
  width: 120px;
  margin-left: 50px;
  border-radius: 30px;
  text-align: center;
  font-size: 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}
.step-input {
  width: 100%;
  border-radius: 20px;
}
.needed-time {
  border-radius: 15px;
  width: 100px;
  height: 30px;
  margin-left: 40px;
}
.recipe-title {
  border-radius: 15px;
}
textarea {
  border-radius: 20px;
  padding: 10px;
}
textarea:focus {
  outline: none;
}
.recipe-img {
  margin-left: 40px;
  border-radius: 10px;
  width: 260px;
}
.submit-recipe-btn {
  background-color: #2c5d63;
  color: white;
  height: 50px;
  width: 180px;
  margin: 0 auto;
  margin-top: 15px;
  border-radius: 30px;
  text-align: center;
  font-size: 20px;
  font-weight: bold;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}
.line {
  margin-top: 25px;
}
</style>