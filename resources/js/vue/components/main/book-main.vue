<template>
  <div class="container">
    <ad-720-300></ad-720-300>
    <div class="row">
      <div class="col-md-4 book-img">
        <carousel :autoplay="true" :nav="false" :items="1" :autoplayTimeout="10000">
          <!-- <img src="/storage/img/books/family-meal.jpg" />
          <img src="/storage/img/books/family-meal.jpg" />
          <img src="/storage/img/books/family-meal.jpg" />-->
          <img
            v-for="(image,index) in images"
            :key="index"
            :src="'/storage/img/books/'+ image.url_image"
            :alt="'urfridge.com |'+ book.title"
          />
        </carousel>
      </div>
      <div class="col-md-8">
        <h1>{{ book.title }}</h1>
        <div class="row">
          <div class="col-6">
            <u>by: {{ book.author }}</u>
          </div>
          <div class="col-6">{{ numberLoves }} loves this</div>
        </div>
        <div class="row mg-tp-40">
          <div class="share">Share this book with your friends</div>
          <share-social-media></share-social-media>
        </div>
        <br />
        <h2>Description:</h2>
        <p>{{ book.description }}</p>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <a :href="book.link">
              <div class="buy-btn">Buy now</div>
            </a>
            <div class="save-btn">
              <font-awesome-icon icon="plus" class="plus-icon" />
              <span class="save-text">save book</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Ad720_300 from '../ads/ad-720-300'
import SocialMedia from '../share-social-media'
import Carousel from 'vue-owl-carousel'

export default {
  components: {
    'ad-720-300': Ad720_300,
    'share-social-media': SocialMedia,
    Carousel
  },
  data: function () {
    return {
      book: {},
      images: [],
      numberLoves: 0,
      url: 'http://' + document.location.hostname + ':8000/api/book/',
    }
  },
  methods: {
    getBookId() {
      var url = window.location.href;
      return url.substring(
        url.lastIndexOf("/book") + 6,
        url.lastIndexOf("/")
      );
    },
    getBook() {
      var id = this.getBookId();
      axios.get(this.url + id)
        .then(response => {
          this.book = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
    getBookImages() {
      var id = this.getBookId();
      axios.get(this.url + id + '/images')
        .then(response => {
          this.images = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
    getNumberLoves() {
      var id = this.getBookId();
      axios.get(this.url + id + '/loves')
        .then(response => {
          this.numberLoves = response.data
        })
        .catch(error => {
          console.log(error);
        })
    }
  },
  created() {
    this.getBook();
    this.getNumberLoves();
    this.getBookImages();
  }

}
</script>

<style scoped>
.mg-tp-40 {
  margin-top: 40px;
}
.share {
  margin-right: 50px;
  padding-top: 5px;
  margin-left: 15px;
}
.buy-btn {
  background-color: #2c5d63;
  color: white;
  border-radius: 20px;
  border: 1px solid gray;
  height: 50px;
  width: 150px;
  font-size: 20px;
  font-weight: bold;
  display: inline-block;
  text-align: center;
  padding-top: 8px;
  cursor: pointer;
}
.save-text {
  display: none;
}
.save-btn {
  background-color: white;
  color: black;
  border-radius: 25px;
  border: 1px solid gray;
  height: 50px;
  width: 50px;
  font-size: 20px;
  font-weight: bold;
  display: inline-block;
  text-align: center;
  padding-top: 8px;
  cursor: pointer;
}
.save-btn:hover {
  width: 150px;
}
.save-btn:hover .save-text {
  display: inline;
}
.save-btn:hover .plus-icon {
  display: none;
}
.owl-dot:focus {
  outline: none !important;
}
.book-img img {
  height: 500px;
  width: 100%;
}
</style>