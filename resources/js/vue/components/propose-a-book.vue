<template>
  <div class="propose-book">
    <div class="row">
      <div class="col-6">
        <h1>Propose a book to us:</h1>
      </div>
      <div class="col-6">
        <div @click="showProposalBox()" class="proposal-btn">Add proposal +</div>
      </div>
    </div>
    <div id="proposal-box">
      <h4>Book's title:</h4>
      <div class="row">
        <div class="col-9">
          <input
            type="text"
            name="book-title"
            id="book-title"
            class="form-control"
            v-model="bookProposal"
          />
        </div>
        <div class="col-3">
          <div class="submit-btn" @click="insertBookProposal">Submit</div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data: function () {
    return {
      bookProposal: '',
      url: 'http://' + document.location.hostname + ':8000/api/book-proposal?title='
    }
  },
  methods: {
    showProposalBox() {
      document.getElementById("proposal-box").style.display = 'block';
    },
    insertBookProposal() {
      axios.post(this.url + this.bookProposal)
        .then(response => {
          console.log(response.data)
        })
        .catch(error => {
          console.log(error);
        })
    }
  }
}
</script>
<style scoped>
.proposal-btn {
  background-color: #2c5d63;
  color: white;
  height: 45px;
  width: 200px;
  position: absolute;
  right: 10px;
  border-radius: 30px;
  text-align: center;
  font-size: 22px;
  font-weight: bold;
  padding-top: 7px;
  cursor: pointer;
}

#proposal-box {
  width: 100%;
  background-color: #283739;
  border-radius: 20px;
  padding: 20px;
  margin-top: 20px;
  display: none;
}

.submit-btn {
  background-color: #2c5d63;
  color: white;
  height: 40px;
  width: 200px;
  margin: 0px;
  border-radius: 30px;
  text-align: center;
  font-size: 22px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  cursor: pointer;
}
input {
  border-radius: 20px;
}
h4 {
  color: white;
}
</style>