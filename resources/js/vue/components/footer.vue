<template>
  <footer>
    <div class="footer-1"></div>
    <div class="footer-text">
      urfridge.com | Created & designed with &#10084;&#65039; by
      <a href="#">Sun Microsystem</a>
    </div>
    <div class="footer-2">
      <a href="#">
        <font-awesome-icon :icon="{ prefix: 'fab', iconName: 'facebook-square' }" />
      </a>
      <a href="#">
        <font-awesome-icon :icon="{ prefix: 'fab', iconName: 'instagram-square'}" />
      </a>
      <a href="#">
        <font-awesome-icon :icon="{ prefix: 'fab', iconName: 'twitter-square'}" />
      </a>
      <a href="#">
        <font-awesome-icon :icon="{ prefix: 'fab', iconName: 'pinterest-square'}" />
      </a>
      <a href="#">
        <font-awesome-icon :icon="{ prefix: 'fab', iconName: 'youtube-square'}" />
      </a>
    </div>
  </footer>
</template>
<script>
export default {
  setup() { },
};
</script>
<style scoped>
footer {
  padding-top: 120px;
}
</style>