/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.js';
import { createApp } from 'vue';

import Swal from 'sweetalert2'
import Form from 'vform'
import Loading from 'vue-loading-overlay';



/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  
//   Toast.fire({
//     icon: 'success',
//     title: 'Signed in successfully'
//   })
  


window.Form = Form;
window.Swal = Swal;



// window.Toast = Toast;

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);


import ProductComponent from './components/ProductComponent.vue';
app.component('product-component', ProductComponent);

// Import and register vform components once
 import { Button, HasError, AlertError, AlertSuccess } from 'vform/src/components/bootstrap5';



  
app.component(Button.name, Button)
app.component(HasError.name, HasError)
app.component(AlertError.name, AlertError)
app.component(AlertSuccess.name, AlertSuccess)



import VueProgressBar from "@aacassandra/vue3-progressbar";
window.options = {
    color: "blue",
    failedColor: "red",
    thickness: "4px",
    transition: {
      speed: "0.2s",
      opacity: "0.6s",
      termination: 400,
    },
    autoRevert: true,
    location: "top",
    inverse: false,
  };
  app.use(VueProgressBar, options)


//   Loading


import {LoadingPlugin} from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
// window.LoadingPlugin = LoadingPlugin;
app.use(LoadingPlugin, {
  color: 'blue',
  width: '90px',
  height: '45px',
  loader: 'dots',
  failedColor: 'red',
  
});




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
