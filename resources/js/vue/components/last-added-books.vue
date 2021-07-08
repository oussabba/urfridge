<template>
  <div>
    <h1>Last added books:</h1>
    <div class="row">
      <div
        v-for="(book,index) in lastAddedBooks "
        :key="index"
        class="col-12 col-sm-6 col-md-3 book"
      >
        <a :href="hostName + book.id + '/' + seoFriendlyTitle(book.title)">
          <img
            :src="'/storage/img/books/'+ book.cover_url[0]"
            :alt="'urfridge.com | ' + book.title"
          />
          {{ book.title }}
        </a>
      </div>
    </div>
    <ad-728-90></ad-728-90>
  </div>
</template>

<script>
import Ad728_90 from './ads/ad-728-90'
export default {
  components: {
    'ad-728-90': Ad728_90,
  },
  data: function () {
    return {
      lastAddedBooks: [],
      url: 'http://' + document.location.hostname + ':8000/api/books/all?l=8',
      hostName: 'http://127.0.0.1:8000/book/',
    }
  },
  methods: {
    getLastAddedBooks() {
      axios.get(this.url)
        .then(response => {
          this.lastAddedBooks = response.data
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
    this.getLastAddedBooks();
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
a {
  text-decoration: none;
  color: #283739;
}
</style>