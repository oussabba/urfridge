<template>
  <div class="search-by-ingredients">
    <h1>Open your fridge !</h1>
    <p>Let's cook delicious dishes using only what you have in your fridge..</p>
    <div class="row">
      <div class="col-md-6 ingredients-in-fridge">
        <h3 class="margin-tp">Choose your availible ingredients:</h3>
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
          >
            <img
              :src="'/assets/img/icons/'+ categorie.icon"
              :alt="'urfridge.com | '+categorie.categorie_label"
            />
            {{ categorie.categorie_label }}
          </option>
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
      <div class="col-md-6 selected-ingredients">
        <div class="row">
          <div class="col-4" v-for="(selectedItem,index) in selectedIngredients " :key="index">
            <div class="selected-ingredient">
              <img
                :src="'/assets/img/icons/'+ selectedItem.icon"
                :alt="'urfridge.com | '+selectedItem.name"
              />
              <br />
              {{selectedItem.name}}
            </div>
          </div>
        </div>
        <div class="clear-btn" @click="clearSelectedList()">Clear all</div>
      </div>
    </div>
    <div class="row">
      <div class="find-btn">Find a recipe</div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      categories: [],
      ingredients: [],
      selectedCategorie: [],
      selectedIngredients: []
    }
  },
  methods: {
    getCategories() {
      axios.get('api/ing-categories')
        .then(response => {
          this.categories = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
    getIngredientsByCategorie(e) {
      let categorie = e.target.value
      axios.get('api/ingredients?cat=' + categorie)
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
    clearSelectedList() {
      this.selectedIngredients = [];
    }
  },
  created() {
    this.getCategories();
    this.getIngredientsByCategorie(1);
  }
}
</script>

<style scoped>
/* .ingredients-in-fridge {
  background-image: url("/assets/img/fridge.png");
  height: 800px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
} */
.ingredients-categorie {
  width: 60%;
  height: 50px;
  border-radius: 20px;
  background-color: #2c5d63;
  color: white;
  text-align: center;
  margin: 50px auto;
}
.selected-ingredients {
  position: relative;
  background-image: url("/assets/img/bg-list.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  border-radius: 30px;
  margin: 50px auto;
  min-height: 600px;
  padding: 30px;
}
.clear-btn {
  background-color: white;
  color: black;
  font-size: 25px;
  padding-top: 8px;
  width: 250px;
  height: 50px;
  border-radius: 20px;
  text-align: center;
  position: absolute;
  bottom: 20px;
  left: 50%;
  transform: translate(-50%, 0);
  cursor: pointer;
}
.ingredients {
  width: 70%;
  margin: auto auto;
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
img {
  width: 30px;
  height: 30px;
}
.find-btn {
  background-color: #2c5d63;
  color: white;
  border-radius: 30px;
  height: 60px;
  width: 250px;
  margin: auto auto;
  font-size: 30px;
  text-align: center;
  padding-top: 10px;
  cursor: pointer;
}
.margin-tp {
  margin-top: 50px;
  text-align: center;
}
.selected-ingredient {
  font-size: 20px;
  color: white;
  text-align: center;
}
.selected-ingredient img {
  height: 60px;
  width: 60px;
}
</style>