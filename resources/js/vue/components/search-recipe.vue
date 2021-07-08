<template>
  <div class="search-recipe">
    <h1>Looking for something?</h1>
    <div class="row margin-20">
      <div class="col-12 col-md-10">
        <input
          class="form-control search-q"
          type="text"
          name="search-query"
          id="search-query"
          v-model="query"
        />
      </div>
      <div class="col-4 col-md-2">
        <div @click="generateUrl()" class="find-btn">find</div>
      </div>
    </div>
    <div class="row recipes-filter">
      <div class="col-md-2">
        <select class="recipe-filter form-control" name="diet" id="diet" v-model="diet">
          <option value disabled selected>Diet?</option>
          <option v-for="(diet,index) in diets " :key="index" :value="diet.idDiet">{{ diet.label }}</option>
        </select>
      </div>
      <div class="col-md-2">
        <select class="recipe-filter form-control" name="time" id="time" v-model="time">
          <option value disabled selected>Preparation time ?</option>
          <option value="0-10">0-10 min</option>
          <option value="11-20">11-20 min</option>
          <option value="21-30">21-30 min</option>
          <option value="31-60">31-60 min</option>
          <option value="1-2">1h-2h</option>
          <option value="+2">+2h</option>
        </select>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      query: '',
      diet: '',
      time: '',
      diets: [],
      searchUrl: '/search?',
    }
  },
  methods: {
    getDiets() {
      axios.get('api/diets')
        .then(response => {
          this.diets = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
    generateUrl() {
      this.searchUrl += "q=" + this.query + "&diet=" + this.diet + "&time=" + this.time;
      window.location.href = this.searchUrl;
    }
  },
  created() {
    this.getDiets();
  }
}
</script>

<style scoped>
.search-recipe {
  margin-top: 30px;
}
.search-q {
  border-radius: 45px;
  height: 45px;
}
.find-btn {
  background-color: #2c5d63;
  color: white;
  height: 45px;
  border-radius: 30px;
  text-align: center;
  font-size: 22px;
  padding-top: 7px;
  cursor: pointer;
}
.margin-20 {
  margin-top: 20px;
  margin-bottom: 20px;
}
.recipe-filter {
  border-radius: 20px;
}
</style>