<template>
  <a :href="hostName + recipe.id + '/' + seoFriendlyTitle(recipe.title)">
    <div class="recipe-card">
      <div class="recipe-card-img">
        <font-awesome-icon icon="heart" class="loved-btn" />
        <div class="save-recipe-btn">
          <font-awesome-icon icon="minus" class="plus-icon" />
          <span class="save-text">unsave recipe</span>
        </div>
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
      hostName: 'http://127.0.0.1:8000/recipe/',
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
  background-color: #ffffff;
  padding: 10px;
}
.recipe-card-body {
  width: 100%;
  min-height: 170px;
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
.save-recipe-btn {
  background-color: #ffffff;
  border-radius: 10px;
  position: absolute;
  right: 7%;
  top: 7%;
  height: 30px;
  width: 30px;
  font-size: 12px;
  padding: 7px 10px;
  cursor: pointer;
}
.save-text {
  display: none;
}
.save-recipe-btn:hover {
  background-color: #ffffff;
  border-radius: 15px;
  position: absolute;
  right: 7%;
  top: 7%;
  height: 30px;
  width: 120px;
  font-size: 14px;
  text-align: center;
  padding-top: 5px;
}
.save-recipe-btn:hover .save-text {
  display: inline;
}
.save-recipe-btn:hover .plus-icon {
  display: none;
}
a {
  text-decoration: none;
  color: #283739;
}
</style>