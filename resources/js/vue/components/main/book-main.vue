<template>
  <div class="container">
    <ad-720-300></ad-720-300>
    <div class="row">
      <div class="col-md-4 book-img">
        <carousel :images="images" :bookTitle="book.title"></carousel>
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
    <div class="row">
      <div class="book-infos">
        <div class="row">
          <div class="col-md-3 info">
            <div class="info-t">Language</div>
            <font-awesome-icon class="icon" icon="language" />
            <div class="info-v">{{ book.language }}</div>
          </div>
          <div class="col-md-3 info">
            <div class="info-t">Print length</div>
            <font-awesome-icon class="icon" icon="file" />
            <div class="info-v">{{ book.number_pages }}</div>
          </div>
          <div class="col-md-3 info">
            <div class="info-t">Publisher</div>
            <font-awesome-icon class="icon" icon="building" />
            <div class="info-v">{{ book.publisher }}</div>
          </div>
          <div class="col-md-3 info">
            <div class="info-t">Publication date</div>
            <font-awesome-icon class="icon" icon="calendar-alt" />
            <div class="info-v">{{ book.publication_date }}</div>
          </div>
        </div>
      </div>
    </div>
    <ad-728-90></ad-728-90>
    <div class="row">
      <h2 class="h2-key">Keywords:</h2>
      <div class="keyword" v-for="(kw,index) in keywords " :key="index">{{ kw.keyword }}</div>
    </div>
    <div class="row">
      <h2 class="h2-key">More like this:</h2>
      <div class="keyword" v-for="(book,index) in relatedBooks " :key="index">{{ book.title }}</div>
    </div>
  </div>
</template>

<script>
import Ad720_300 from '../ads/ad-720-300'
import Ad728_90 from '../ads/ad-728-90'
import SocialMedia from '../share-social-media'
import Carousel from '../owl-carousel'

export default {
  components: {
    'ad-720-300': Ad720_300,
    'ad-728-90': Ad728_90,
    'share-social-media': SocialMedia,
    'carousel': Carousel,
  },
  data: function () {
    return {
      book: {},
      images: [],
      keywords: [],
      relatedBooks: [],
      // urlKeywords: '',
      numberLoves: 0,
      url: 'http://' + document.location.hostname + ':8000/api/',
    }
  },
  computed: {
    urlKeywords: function () {
      // let urlK = "";
      // this.keywords.forEach(keyword => urlK += "k[]=" + keyword.id_keyword + "&");
      // return urlK;
      let item = this.keywords.find((item) => item.id_keyword == 1)
      return item.keyword
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
      axios.get(this.url + 'book/' + id)
        .then(response => {
          this.book = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
    getBookImages() {
      var id = this.getBookId();
      axios.get(this.url + 'book/' + id + '/images')
        .then(response => {
          this.images = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
    getKeywords() {
      var id = this.getBookId();
      axios.get(this.url + 'book/' + id + '/keywords')
        .then(response => {
          this.keywords = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
    getNumberLoves() {
      var id = this.getBookId();
      axios.get(this.url + 'book/' + id + '/loves')
        .then(response => {
          this.numberLoves = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
    getRelatedBooks() {
      console.log(this.urlKeywords);
      // let urlK = "";
      // urlK = this.keywords.join('&k[]=');
      // console.log(urlK);
      // for (let i = 0; i < this.$data.keywords.length; i++) {
      //   // urlK += "k[]=" + this.keywords[i].id_keyword + "&";
      //   console.log("0");
      // }

      // $.each(this.$data.keywords, function (value) {
      //   urlK += "k[]=" + value.id_keyword + "&";
      // });

      // axios.get(this.url + 'books?' + urlK)
      //   .then(response => {
      //     this.relatedBooks = response.data
      //   })
      //   .catch(error => {
      //     console.log(error);
      //   })
    },
  },
  created() {
    this.getBook();
    this.getNumberLoves();
    this.getBookImages();
    this.getKeywords();
    this.getRelatedBooks();
  },

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
.book-infos {
  width: 75%;
  height: 150px;
  margin: 20px auto;
  border: 1px solid #2c5d63;
  border-radius: 20px;
}
.info {
  text-align: center;
  margin-top: 20px;
}
.icon {
  font-size: 45px;
  margin: 10px auto;
}
.info-v {
  font-size: 20px;
  font-weight: bold;
}
.keyword {
  display: inline-block;
  background-color: #283739;
  color: white;
  border-radius: 20px;
  margin-right: 5px;
  margin-top: 3px;
  padding: 5px 10px;
  border: 0.5px solid gray;
  height: 35px;
}
.h2-key {
  margin-right: 30px;
  margin-left: 15px;
}
</style>