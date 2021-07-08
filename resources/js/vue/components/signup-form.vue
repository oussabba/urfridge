<template>
  <div class="container">
    <div class="row">
      <h1 class="centred-h1">Sign up</h1>
    </div>
    <div class="row">
      <div class="signup-form">
        <form action="#" method="POST">
          <div class="row margin-tp-10">
            <div class="col-12 col-md-4">
              <label for="email">Email :</label>
            </div>
            <div class="col-12 col-md-8">
              <input type="email" name="email" id="email" class="form-control form-input" />
            </div>
          </div>
          <div class="row margin-tp-10">
            <div class="col-12 col-md-4">
              <label for="username">Username :</label>
            </div>
            <div class="col-12 col-md-8">
              <input type="username" name="username" id="username" class="form-control form-input" />
            </div>
          </div>
          <div class="row margin-tp-10">
            <div class="col-12 col-md-4">
              <label for="password">Password :</label>
            </div>
            <div class="col-12 col-md-8">
              <input type="password" name="password" id="password" class="form-control form-input" />
            </div>
          </div>
          <div class="row margin-tp-10">
            <div class="col-12 col-md-4">
              <label for="password-confirm">Confirm password :</label>
            </div>
            <div class="col-12 col-md-8">
              <input
                type="password"
                name="password-confirm"
                id="password-confirm"
                class="form-control form-input"
              />
            </div>
          </div>
          <div class="row">
            <input type="submit" value="Sign up" name="submit" class="submit-btn" />
          </div>
          <div class="row">
            <div class="col-2"></div>
            <div class="col-1">
              <input
                type="checkbox"
                name="terms-of-use"
                id="terms-of-use"
                class="form-control checkbox-form"
              />
            </div>
            <div class="col-9">
              <label for="terms-of-use" class="form-sentence">
                I agree to
                <a href="#">terms of use</a> &
                <a href="#">privacy policy</a>
              </label>
            </div>
          </div>
        </form>
        <hr />
        <div class="row">
          <div class="col-12 col-md-6">
            <a href="#">
              <div class="google-auth">
                <img src="\assets\img\google-logo.png" alt="urfridge.com | Logo google png" />
                Sign up with Google
              </div>
            </a>
          </div>
          <div class="col-12 col-md-6">
            <a href="#">
              <div class="facebook-auth">Sign up with Facebook</div>
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
      username: '',
      email: '',
      password: ''
    }
  }
};
</script>
<style scoped>
hr {
  margin: 10px;
}
</style>