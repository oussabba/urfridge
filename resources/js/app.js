require("./bootstrap");

import Vue from "vue";
import Navbar from "./vue/components/navbar";
import Appfooter from "./vue/components/footer";
import SocialMediaBar from "./vue/components/social-media-bar";
import SigninForm from "./vue/components/signin-form";
import SignupForm from "./vue/components/signup-form";
//import CarouselBanner from "./vue/components/carousel-banner";
import HomeMain from "./vue/components/main/home-main";

import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faHome,
    faSearch,
    faCompass,
    faDrumstickBite,
    faBook,
    faSignInAlt,
    faUserPlus
} from "@fortawesome/free-solid-svg-icons";
import {
    faFacebookSquare,
    faInstagramSquare,
    faTwitterSquare,
    faPinterestSquare,
    faYoutubeSquare
} from "@fortawesome/free-brands-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(
    faHome,
    faSearch,
    faCompass,
    faDrumstickBite,
    faBook,
    faSignInAlt,
    faUserPlus,
    faFacebookSquare,
    faInstagramSquare,
    faTwitterSquare,
    faPinterestSquare,
    faYoutubeSquare
);
Vue.component("font-awesome-icon", FontAwesomeIcon);

const app = new Vue({
    el: "#app",
    components: {
        Navbar,
        Appfooter,
        SocialMediaBar,
        SigninForm,
        SignupForm,
        //CarouselBanner,
        HomeMain
    }
});
