<!-- SupplierAddForm.vue -->

<template>
  <div class="container mt-5">
    <h2 class="mb-4">Add Supplier Details</h2>
    <form @submit.prevent="submitForm">
      <div class="mb-3">
        <label for="supplierName" class="form-label">Supplier Name:</label>
        <input v-model="supplierName" type="text" class="form-control" id="supplierName" required />
      </div>

      <div class="mb-3">
        <label for="contactPerson" class="form-label">Contact Person:</label>
        <input v-model="contactPerson" type="text" class="form-control" id="contactPerson" required />
      </div>

      <div class="mb-3">
        <label for="mobileNumbers" class="form-label">Mobile Numbers:</label>
        <input v-model="mobileNumbers" type="text" class="form-control" id="mobileNumbers" required />
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      supplierName: '',
      contactPerson: '',
      mobileNumbers: '',
    };
  },
  methods: {
    submitForm() {
      const supplierData = {
        name: this.supplierName,
        contact_person: this.contactPerson,
        mobile_numbers: this.mobileNumbers,
      };

      axios.post('http://127.0.0.1:8000/api/suppliers', supplierData)
        .then(response => {
          console.log('Supplier added successfully:', response.data);
          this.$router.push({ name: 'view-suppliers' });
        })
        .catch(error => {
          console.error('Error adding supplier:', error);
        });
    },
  },
};
</script>
