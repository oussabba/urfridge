<template>
  <div claas="most-loved-books-section">
    <h1>Most loved books:</h1>
    <div class="row">
      <div class="col-md-7">
        <div class="row">
          <div v-for="(book,index) in mostLovedBooks " :key="index" class="book col-md-6">
            <a :href="hostName + book.id + '/' + seoFriendlyTitle(book.title)">
              <img
                :src="'/storage/img/books/'+ book.cover_url[0]"
                :alt="'urfridge.com | ' + book.title"
              />
              <div class="book-title">{{ book.title }}</div>
              <center>
                <hr />
              </center>
              <div class="book-loves">
                {{ book.loves }}
                <font-awesome-icon icon="heart" class="heart" />&nbsp;this
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <ad-300-600></ad-300-600>
      </div>
    </div>
  </div>
</template>

<script>
import Ad300_600 from './ads/ad-300-600'
export default {
  components: {
    'ad-300-600': Ad300_600,
  },
  data: function () {
    return {
      mostLovedBooks: [],
      url: 'http://' + document.location.hostname + ':8000/api/books/sorted/loves?l=6',
      hostName: 'http://127.0.0.1:8000/book/',
    }
  },
  methods: {
    getMostLovedBooks() {
      axios.get(this.url)
        .then(response => {
          this.mostLovedBooks = response.data
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
    }
  },
  created() {
    this.getMostLovedBooks();
  }

}
</script>
<style scoped>
img {
  height: 350px;
  width: 100%;
}
.book {
  text-align: center;
  font-size: 18px;
}
.heart {
  color: red;
}
hr {
  margin: auto 8px;
  width: 70%;
}
.book-title {
  min-height: 55px;
}
a {
  text-decoration: none;
  color: #283739;
}
</style>