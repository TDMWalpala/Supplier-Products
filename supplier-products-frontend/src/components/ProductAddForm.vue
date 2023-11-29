<!-- ProductAddForm.vue -->

<template>
  <div class="container mt-5">
    <h2>Add Product</h2>
    <form @submit.prevent="submitForm">
      <div class="mb-3">
        <label for="productName" class="form-label">Product Name:</label>
        <input v-model="productName" type="text" class="form-control" id="productName" required />
      </div>

      <div class="mb-3">
        <label for="productPrice" class="form-label">Product Price:</label>
        <input v-model="productPrice" type="number" class="form-control" id="productPrice" required />
      </div>

      <div class="mb-3">
        <label for="productImage" class="form-label">Product Image:</label>
        <input type="file" ref="fileInput" accept="image/*" @change="handleFileChange" class="form-control" />
        <img v-if="productImage" :src="productImage" alt="Product Image" class="mt-2" style="max-width: 100px; max-height: 100px;" />
      </div>

      <p class="mb-3">Supplier ID: {{ supplierId }}</p>

      <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
  </div>
</template>


<script>
import axios from 'axios';

export default {
  props: ['supplierId'], 
  data() {
    return {
      productName: '',
      productPrice: '',
      productImage: null,
    };
  },
  methods: {
    submitForm() {
      const formData = new FormData();
      formData.append('name', this.productName);
      formData.append('price', this.productPrice);
      formData.append('image', this.$refs.fileInput.files[0]);
      formData.append('supplier_id', this.supplierId);

      axios.post('http://127.0.0.1:8000/api/products', formData)
        .then(response => {
          console.log('Product added successfully:', response.data);
          this.$router.push({ name: 'view-products' });
        })
        .catch(error => {
          console.error('Error adding product:', error);
        });
    },
    handleFileChange() {
      const file = this.$refs.fileInput.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = () => {
          this.productImage = reader.result;
        };
        reader.readAsDataURL(file);
      }
    },
  },
};
</script>
