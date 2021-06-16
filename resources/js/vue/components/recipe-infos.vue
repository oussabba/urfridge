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
      <div class="row mg-tp-20">
        <div class="col-md-9">
          <div class="infos-recipe">
            <div class="row">
              <div class="col-md-4">
                <div class="info">{{ recipe.total_time }} min</div>
                <span>Total time</span>
              </div>
              <div class="col-md-3">
                <div class="info">{{ recipe.nmbre_ingredients }}</div>
                <span>Ingredients</span>
              </div>
              <div class="col-md-5">
                <div class="info">
                  <font-awesome-icon icon="heart" class="heart" />
                </div>
                <span>-----</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="save-btn">Save</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['recipe'],
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
.mg-tp-20 {
  margin-top: 20px;
}
</style>