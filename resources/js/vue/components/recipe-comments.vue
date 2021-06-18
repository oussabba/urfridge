<template>
  <div class="comments-section">
    <div class="row">
      <div class="col-2">
        <h2>Comments:</h2>
      </div>
      <div class="col">
        <hr />
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <textarea name="comment" id="comment" cols="90" rows="4" placeholder="What's on your mind?"></textarea>
      </div>
      <div class="col-md-3 cmt">
        <div class="comment-btn">Comment</div>
      </div>
    </div>
    <div class="row" v-for="(comment,index) in comments " :key="index">
      <div class="comment">
        <h5>{{ comment.name }}</h5>
        <p>{{ comment.text }}</p>
      </div>
    </div>
    <hr />
  </div>
</template>
<script>
export default {
  data: function () {
    return {
      comments: [],
      url: 'http://' + document.location.hostname + ':8000/api/recipe/'
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
    getComments() {
      var id = this.getRecipeId();
      axios.get(this.url + id + '/comments')
        .then(response => {
          this.comments = response.data
        })
        .catch(error => {
          console.log(error);
        })
    },
  },
  created() {
    this.getComments();
  }
}
</script>
<style scoped>
textarea {
  padding: 15px;
}
.comment-btn {
  background-color: #2c5d63;
  color: white;
  border-radius: 20px;
  border: 1px solid gray;
  height: 45px;
  width: 180px;
  font-size: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}
.cmt {
  display: flex;
  align-items: center;
  justify-content: center;
}
.comment {
  background-color: #cbcbcb;
  border: 1px solid gray;
  width: 95%;
  margin: 10px auto;
  padding: 15px;
  border-radius: 15px;
}
</style>