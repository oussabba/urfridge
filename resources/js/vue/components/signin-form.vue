<template>
  <div class="container">
    <div class="row">
      <h1 class="centred-h1">Sign in</h1>
    </div>
    <div class="row">
      <div class="signin-form">
        <form action="#" method="POST">
          <div class="row margin-tp-10">
            <div class="col-12 col-md-4">
              <label for="user">Email :</label>
            </div>
            <div class="col-12 col-md-8">
              <input
                type="email"
                name="user"
                id="user"
                class="form-control form-input"
                v-model="user.email"
              />
            </div>
          </div>
          <div class="row margin-tp-10">
            <div class="col-12 col-md-4">
              <label for="password">Password :</label>
            </div>
            <div class="col-12 col-md-8">
              <input
                type="password"
                name="password"
                id="password"
                class="form-control form-input"
                v-model="user.password"
              />
            </div>
          </div>
          <div class="row">
            <input @click="login" type="submit" value="Sign in" name="submit" class="submit-btn" />
          </div>
          <div class="row">
            <p class="form-sentence">
              You don't have an account yet ?
              <a href="signup">Register NOW</a>
            </p>
          </div>
        </form>
        <hr />
        <div class="row">
          <div class="col-12 col-md-6">
            <a href="#">
              <div class="google-auth">
                <img src="\assets\img\google-logo.png" alt="urfridge.com | Logo google png" />
                Sign in with Google
              </div>
            </a>
          </div>
          <div class="col-12 col-md-6">
            <a href="#">
              <div class="facebook-auth">Sign in with Facebook</div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data: function () {
    return {
      user: {
        email: '',
        password: '',
      }
    }
  },
  methods: {
    login() {
      this.$store.dispatch('currentUser/loginUser', this.user)
    },
  }
};
</script>
<style scoped>
hr {
  margin: 10px;
}
</style>