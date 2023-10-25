<template>
  <div class="container my-5">
    <div class="row">
      <div class="col-8 offset-4">
        <nav class="navbar bg-light">
          <div class="container-fluid">
            <button class="btn btn-primary" @click="create">
              <i class="bi bi-plus-circle"></i>
              Create
            </button>

            <!-- @submit.prevent="searchProduct"    method 1  -->
            <form class="d-flex" role="search" @submit.prevent="view">
              <div class="input-group">
                <input
                  v-model="search"
                  class="form-control me-2"
                  type="text"
                  placeholder="Search"
                  aria-label="Search"
                />
                <div class="input-group-append">
                  <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="col-4">
        <!-- .card>.card-header+.card-body -->
        <div class="card">
          <h3 class="card-header">
            {{
              idEditMode
                ? "Edit" + " " + "Product" + " " + product.id
                : "Create Page"
            }}
          </h3>
          <div class="card-body">
            <!--  -->

            <!-- :message = v-bind:message -->

            <form
              action=""
              @submit.prevent="idEditMode ? update() : store()"
              @keydown="product.onKeydown($event)"
            >
              <div class="form-group mb-3">
                <label>Name: </label>
                <input
                  v-model="product.name"
                  type="text"
                  class="form-control"
                  name="name"
                />
                <HasError :form="product" field="name" />
              </div>

              <div class="form-group mb-3">
                <label>Price: </label>
                <input
                  v-model="product.price"
                  type="number"
                  class="form-control"
                  name="price"
                />
                <HasError :form="product" field="price" />
              </div>

              <!-- @click="store" -->
              <button class="btn btn-primary" type="submit">
                <i class="bi bi-floppy"></i>
                Save
              </button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-8">
        <table class="table table-striped">
          <thead>
            <!-- tr>th*4 -->
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Price</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in products.data" :key="product.id" scope="row">
              <td>{{ product.id }}</td>
              <td>{{ product.name }}</td>
              <td>{{ product.price }}</td>
              <td>
                <button
                  type="button"
                  class="btn btn-primary mr-1"
                  @click="edit(product)"
                >
                  <i class="bi bi-pencil-square"></i>Edit
                </button>
                <button
                  type="button"
                  class="btn btn-danger mr-1"
                  @click="destroy(product.id)"
                >
                  <i class="bi bi-trash"></i>
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Table End -->

      <!-- Pagination -->
      <Bootstrap5Pagination :data="products" @pagination-change-page="view" />
      <!-- End Pagination  -->

      <!-- Loading  -->
      <!-- <loading v-model:active="isLoading"              no need
                 :is-full-page="true"/> -->
      <!-- End Loading -->
    </div>
  </div>
</template>

<!-- <script>
export default {
  name:'ProductComponent',
  data(){
    return {
      products: []
    }
  },
  created(){
    // axios.put()
    axios.get('/api/product')
    // .then(response=>{ console.log(response) })
    .then(response => {
      this.products = response.data
    })
    .catch(error =>{ console.log(error) })
  }
};
</script> -->


<script setup>
import { Bootstrap5Pagination } from "laravel-vue-pagination";

// import Form from 'vform'
// import { Button, HasError, AlertError } from 'vform/src/components/bootstrap5'

// loading
</script>

<script>
export default {
  name: "ProductComponent",
  // components: {
  //   Button, HasError, AlertError
  // },

  data() {
    return {
      // default
    //   isLoading: false,
      //fullPage: false,
      idEditMode: false,
      search: "",
      products: {},
      // product: {
      //       id: '',
      //       name: '',
      //       price: ''
      // }
      product: new Form({
        //vform
        id: "",
        name: "",
        price: "",
      }),
      message: "",
    };
  },
  methods: {
    //[Part-1]   searchProduct and view = (2 methods)
    // searchProduct() {
    //   axios.get('/api/product?search=' + this.search)
    //   // .then(response => console.log(response))
    //   .then(response => {
    //     this.products = response.data
    //   })
    // },
    // view(page = 1) {
    //     axios.get('/api/product?page=' + page)
    //     .then( response => {
    //         this.products = response.data
    //     })
    //     .catch(error =>{ console.log(error) });
    // },

    /* ---------------------------------------------------------------------------------------------------------- */
    //[Part-2]   searchProduct + view = (reduce code) 1 method

    view(page = 1) {
      this.$Progress.start();

      // let loader = this.$loading.show({
      //   // Optional parameters
      //   container: this.fullPage ? null : this.$refs.formContainer,
      //   canCancel: false,
      //   // onCancel: this.onCancel,
      // });
      // simulate AJAX
    //   setTimeout(() => {
    //     // loader.hide();
    //   }, 5000);
      //   this.isLoading = true;

      // fix as u like 
      let loader = this.$loading.show();


      axios
        .get(`/api/product?page=${page}&search=${this.search}`)
        .then((response) => {
          this.products = response.data;
          this.$Progress.finish();

          //   if ajax is success

          
          // this.isLoading = false;        no need
          loader.hide();


        })
        .catch((error) => {
          this.$Progress.fail();
          //   this.isLoading = false;      no need
          loader.hide();
          console.log(error);
        });
    },

    create() {
      this.product.clear();
      this.isEditMode = false;
      // this.product.id = '';
      // this.product.name = '';
      // this.product.price = '';
      this.product.reset();
    },

    store() {
      // axios.post('/api/product', this.product)
      this.product
        .post("/api/product")
        .then((response) => {
          // this.view();
          // this.product = { name: '', price: ''};

          // // Instead of calling this.view(), just add the new product to this.products
          // this.products.push(this.product);
          // this.product = { name: '', price: ''};

          this.view();

          // this.product.id = "";
          // this.product.name = "";
          // this.product.price = "";

          //Instead

          this.product.reset();
          Toast.fire({
            icon: "success",
            title: "Created in successfully",
          });
        })
        .catch((error) => {
          this.message = error.response.data.message;
          // console.log(error.response.data.message);
        });
    },

    edit(product) {
      this.product.clear();
      this.idEditMode = true;

      // this.product.id = product.id;
      // this.product.name = product.name;
      // this.product.price = product.price;

      /* Instead */

      this.product.fill(product);
    },

    update() {
      axios
        .put(`/api/product/${this.product.id}`, this.product)
        .then((response) => {
          this.view();
          // this.product.id = "";
          // this.product.name = "";
          // this.product.price = "";

          //Instead

          this.product.reset();
          Toast.fire({
            icon: "success",
            title: "Updated in successfully",
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },

    destroy(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete(`/api/product/${id}`).then((response) => this.view());

          Swal.fire("Deleted!", "Your file has been deleted.", "success");

          Toast.fire({
            icon: "success",
            title: "Deleted in successfully",
          });
        }
      });

      // if(! confirm('Are you sure to delete?')){
      //     return;
      // }
    },
  },
  created() {
    this.view();
  },
};
</script>
