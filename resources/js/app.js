require("./bootstrap");

import Vue from "vue";
import Navbar from "./vue/components/navbar";
import Appfooter from "./vue/components/footer";
import SocialMediaBar from "./vue/components/social-media-bar";
import SigninForm from "./vue/components/signin-form";
import SignupForm from "./vue/components/signup-form";
import HomeMain from "./vue/components/main/home-main";
import RecipeMain from "./vue/components/main/recipe-main";
import BookMain from "./vue/components/main/book-main";
import SearchMain from "./vue/components/main/search-main";

import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faHome,
    faSearch,
    faCompass,
    faDrumstickBite,
    faBook,
    faSignInAlt,
    faUserPlus,
    faHeart,
    faPlus,
    faLanguage,
    faFile,
    faBuilding,
    faCalendarAlt
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
    faHeart,
    faFacebookSquare,
    faInstagramSquare,
    faTwitterSquare,
    faPinterestSquare,
    faYoutubeSquare,
    faPlus,
    faLanguage,
    faFile,
    faBuilding,
    faCalendarAlt
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
        HomeMain,
        RecipeMain,
        BookMain,
        SearchMain
    }
});
