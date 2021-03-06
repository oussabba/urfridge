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
import BooksMain from "./vue/components/main/books-main";
import RecipesMain from "./vue/components/main/recipes-main";
import ExploreMain from "./vue/components/main/explore-main";
import DashboardMain from "./vue/components/main/dashboard-main";
import ResultSearchMain from "./vue/components/main/result-search-main";
import ResultSearchByTitle from "./vue/components/result-search-by-title";

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
    faMinus,
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
    faMinus,
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
        SearchMain,
        BooksMain,
        RecipesMain,
        ExploreMain,
        "dashboard-main": DashboardMain,
        "result-search-main": ResultSearchMain,
        "result-search-by-title": ResultSearchByTitle
    }
});
