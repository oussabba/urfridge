require("./bootstrap");

import Vue from "vue";
import Navbar from "./vue/components/navbar";
import Appfooter from "./vue/components/footer";
import SocialMediaBar from "./vue/components/social-media-bar";
import SigninForm from "./vue/components/signin-form";
import SignupForm from "./vue/components/signup-form";

const app = new Vue({
    el: "#app",
    components: {
        Navbar,
        Appfooter,
        SocialMediaBar,
        SigninForm,
        SignupForm
    }
});
