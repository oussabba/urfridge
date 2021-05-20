require('./bootstrap');

import Vue from 'vue'
import Navbar from './vue/components/navbar' 

const app = new Vue({
    el:'#app',
    components:{
        Navbar
    }
})
