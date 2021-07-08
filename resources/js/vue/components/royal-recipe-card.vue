<template>
  <a :href="hostName + recipe.id + '/' + seoFriendlyTitle(recipe.title)">
    <div class="recipe-card">
      <div class="recipe-card-img">
        <img class="crown" src="/assets/img/icons/crown.png" alt="urfridge.com | crown icon png" />
        <font-awesome-icon icon="heart" class="loved-btn" />
        <img :src="'/storage/img/recipes/'+ recipe.image_url" alt="#" />
      </div>
      <div class="recipe-card-body">
        <h4 class="recipe-title">{{ recipe.title }}</h4>
        <p class="recipe-desc">{{ recipe.description | subStr }}</p>
        <div class="loved-by">{{ recipe.number_loves }} &#10084;&#65039; this</div>
      </div>
    </div>
  </a>
</template>

<script>
export default {
  props: ["recipe"],
  data: function () {
    return {
      hostName: 'http://127.0.0.1:8000/royal-recipe/',
    }
  },
  methods: {
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
      return string.substring(0, 60) + '...';
    },
  },
}
</script>

<style lang="scss" scoped>
.recipe-card {
  margin-top: 20px;
  border: #707070 solid 0.5px;
}
.recipe-card-body {
  background-color: #283739;
  padding: 10px;
  width: 100%;
  color: white;
  min-height: 150px;
  position: relative;
}
.recipe-card-img {
  height: 220px;
}
img {
  width: 100%;
  height: 100%;
}
h4 {
  text-align: center;
}
.loved-by {
  font-size: 18px;
  // text-align: center;
  position: absolute;
  bottom: 5px;
  left: 50%;
  transform: translate(-50%, 0);
}
.loved-btn {
  color: white;
  font-size: 27px;
  position: absolute;
  left: 7%;
  top: 7%;
  text-shadow: 2px 2px #ff0000;
  cursor: pointer;
}
.loved-btn:hover {
  color: red;
}
.crown {
  position: absolute;
  right: -5px;
  top: -10px;
  width: 60px;
  height: 60px;
  transform: rotate(20deg);
}
a {
  text-decoration: none;
  color: #283739;
}
</style>