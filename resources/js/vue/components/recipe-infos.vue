<template>
  <div class="margin-tp-50 row">
    <div class="col-md-5">
      <img
        class="recipe-img"
        :src="'/storage/img/recipes/'+ recipe.image_url"
        :alt="'urfridge.com | '+ recipe.title"
      />
    </div>
    <div class="col-md-7">
      <h1>{{ recipe.title }}</h1>
      <h6>By: Admin</h6>
      <h6 class="diet">Diet:</h6>
      <div class="row mg-tp-40">
        <div class="col-md-9">
          <div class="infos-recipe">
            <div class="row">
              <div class="col-md-4">
                <div class="info">{{ recipe.total_time }} min</div>
                <span>Total time</span>
                <div class="vl"></div>
              </div>
              <div class="col-md-3">
                <div class="info">{{ recipe.nmbre_ingredients }}</div>
                <span>Ingredients</span>
              </div>
              <div class="col-md-5">
                <div class="info">
                  <font-awesome-icon icon="heart" class="heart" />
                </div>
                <span>{{ numberLoves }} loves this</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="save-btn">Save</div>
        </div>
      </div>
      <div class="row mg-tp-40">
        <div class="share">Share this recipe</div>
        <social-media></social-media>
      </div>
    </div>
  </div>
</template>

<script>
import SocialMedia from './share-social-media.vue'
export default {
  components: {
    SocialMedia,
  },
  props: ['recipe'],
  data: function () {
    return {
      numberLoves: 0,
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
    getRecipeLoves() {
      var id = this.getRecipeId();
      axios.get('http://' + document.location.hostname + ':8000/api/recipe/' + id + '/loves')
        .then(response => {
          this.numberLoves = response.data
        })
        .catch(error => {
          console.log(error);
        })
    }
  },
  created() {
    this.getRecipeLoves();
  }
}
</script>

<style scoped>
.recipe-img {
  width: 100%;
  height: 300px;
  border-radius: 5px;
}
.margin-tp-50 {
  margin-top: 50px;
}
h6 {
  display: inline;
}
.diet {
  margin-left: 200px;
}
.infos-recipe {
  background-color: white;
  width: 100%;
  height: 60px;
  border-radius: 30px;
  border: 1px solid gray;
}
.save-btn {
  background-color: white;
  border-radius: 20px;
  border: 1px solid gray;
  height: 60px;
  font-size: 24px;
  font-weight: bold;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}
.info {
  font-size: 25px;
  font-weight: bold;
  height: 35px;
  display: flex;
  align-items: center;
  justify-content: center;
}
span {
  display: flex;
  align-items: center;
  justify-content: center;
}
.heart {
  color: red;
}
.mg-tp-40 {
  margin-top: 40px;
}
.vl {
  border-left: 2px solid gray;
  height: 50px;
  position: absolute;
  right: 0;
  top: 5px;
}
.share {
  font-size: 20px;
  margin-left: 40px;
  margin-right: 40px;
  padding-top: 5px;
}
</style>