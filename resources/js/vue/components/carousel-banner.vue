<template>
  <div id="carouselBannerIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li
        v-for="slide in bannerSlides"
        :key="slide.id"
        data-target="#carouselBannerIndicators"
        data-slide-to="0"
        :class="slide.id==1 ? 'active':''"
      ></li>
    </ol>
    <div class="carousel-inner">
      <div
        v-for="slide in bannerSlides"
        :key="slide.id"
        :class="slide.id==1 ? 'carousel-item active':'carousel-item'"
      >
        <img class="d-block w-100" :src="slide.image_url" alt="Second slide" />
        <div class="carousel-caption">
          <h2>{{ slide.title }}</h2>
          <p>{{ slide.sub_title }}</p>
        </div>
      </div>
    </div>
    <a
      class="carousel-control-prev"
      href="#carouselBannerIndicators"
      role="button"
      data-slide="prev"
    >
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a
      class="carousel-control-next"
      href="#carouselBannerIndicators"
      role="button"
      data-slide="next"
    >
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      bannerSlides: []
    }
  },
  methods: {
    getBannerSlides() {
      axios.get('api/banner')
        .then(response => {
          this.bannerSlides = response.data
        })
        .catch(error => {
          console.log(error);
        })
    }
  },
  created() {
    this.getBannerSlides();
  }
}
</script>

<style scoped>
/* img {
  margin: auto;
} */
.carousel-inner {
  width: 100%;
  margin: 20px auto;
  border-radius: 20px;
}
/* .carousel-control-prev {
  left: 0%;
}
.carousel-control-next {
  right: 0%;
} */
.carousel-inner h2,
p {
  color: #283739 !important;
}
</style>