<template>
  <div class="container result-search">
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
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data: function () {
    return {
      url: 'http://' + document.location.hostname + ':8000/api/',
      recipes: [],
      hostName: 'http://127.0.0.1:8000/recipe/'
    }
  },
  methods: {
    getRecipes() {
      axios.get(this.url + 'searchRecipes' + window.location.search)
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
    this.getRecipes();
  }
}
</script>
<style scoped>
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
a {
  color: black;
  text-decoration: none;
}
</style>