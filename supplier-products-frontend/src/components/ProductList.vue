<!-- ProductList.vue -->
<template>
  <div class="mt-2 mx-5 p-2">
    <h2>Product List</h2>

    <p>Page {{ currentPage }} of {{ totalPages }}</p>

    <div class="row">
      <div v-for="product in products" :key="product.id" class="col-md-4 mb-4">
        <div class="card">
          <img
            :src="getImageUrl(product.image)"
            alt="Product Image"
            class="card-img-top"
            style="max-height: 200px; object-fit: cover"
          />
          <div class="card-body">
            <h5 class="card-title">{{ product.name }}</h5>
            <div class="d-flex justify-content-between">
              <p class="card-text fst-italic">Price ${{ product.price }}</p>
              <p class="card-text fst">
                Supplier ID : {{ product.supplier_id }}
              </p>
            </div>

            <button @click="deleteProduct(product.id)" class="btn btn-danger">
              Delete Product
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-4 d-flex justify-content-center mb-5">
      <button
        @click="prevPage"
        :disabled="currentPage === 1"
        class="btn btn-secondary mx-3 px-4"
      >
        Previous
      </button>
      <button
        @click="nextPage"
        :disabled="currentPage === totalPages"
        class="btn btn-primary mx-3 px-5"
      >
        Next
      </button>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      products: [],
      currentPage: 1,
      totalPages: 1,
    };
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    fetchProducts() {
      axios
        .get(`http://127.0.0.1:8000/api/products?page=${this.currentPage}`)
        .then((response) => {
          this.products = response.data.data;
          this.currentPage = response.data.current_page;
          this.totalPages = response.data.last_page;
        })
        .catch((error) => {
          console.error("Error fetching products:", error);
        });
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage += 1;
        this.fetchProducts();
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage -= 1;
        this.fetchProducts();
      }
    },
    getImageUrl(imagePath) {
      return `http://127.0.0.1:8000/${imagePath}`;
    },
    deleteProduct(productId) {
      if (confirm("Are you sure you want to delete this product?")) {
        axios
          .delete(`http://127.0.0.1:8000/api/products/${productId}`)
          .then((response) => {
            this.fetchProducts();
          })
          .catch((error) => {
            console.error("Error deleting product:", error);
          });
      }
    },
  },
};
</script>
