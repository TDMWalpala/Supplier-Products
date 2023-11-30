<template>
  <div class="mt-2 mx-5 p-2">
    <h2>Supplier List</h2>
    <p>Page {{ currentPage }} of {{ totalPages }}</p>
    <div class="input-group mb-3 mx-8 p-1 container-sm">
      <input
        v-model="searchQuery"
        type="text"
        class="form-control"
        placeholder="Search suppliers..."
      />
      <button @click="search" class="btn btn-primary">Search</button>
    </div>

    <ul class="list-group">
      <li
        v-for="supplier in suppliers"
        :key="supplier.id"
        class="list-group-item list-group-item-light mx-5 d-flex justify-content-between"
      >
        <div class="d-flex justify-content-evenly p-2 mx-2">
          <p class="fw-bold fs-5 mx-2">{{ supplier.name }}</p>
          <p class="fw-medium fs-5 mx-4">{{ supplier.contact_person }}</p>
          <p class="fw-medium fs-5">{{ supplier.mobile_numbers }}</p>
        </div>
        <div class="d-flex justify-content-evenly p-2">
          <router-link
            :to="{ name: 'add-product', params: { supplierId: supplier.id } }"
          >
            <button class="btn btn-success mx-4">Add Product</button>
          </router-link>
          <button
            @click="showUpdateForm(supplier)"
            class="btn btn-warning mx-4"
          >
            Update Supplier
          </button>
          <button
            @click="deleteSupplier(supplier.id)"
            class="btn btn-danger mx-4"
          >
            Delete Supplier
          </button>
        </div>
      </li>
    </ul>

    <div class="mt-4 d-flex justify-content-center">
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

    <div v-if="showUpdate" class="mt-4">
      <h3 class="mb-4">Update Supplier</h3>
      <form @submit.prevent="updateSupplier">
        <div class="mb-3">
          <label for="updateSupplierName" class="form-label"
            >Supplier Name:</label
          >
          <input
            v-model="updateSupplierName"
            type="text"
            class="form-control"
            id="updateSupplierName"
            required
          />
        </div>

        <div class="mb-3">
          <label for="updateContactPerson" class="form-label"
            >Contact Person:</label
          >
          <input
            v-model="updateContactPerson"
            type="text"
            class="form-control"
            id="updateContactPerson"
            required
          />
        </div>

        <div class="mb-3">
          <label for="updateMobileNumbers" class="form-label"
            >Mobile Numbers:</label
          >
          <input
            v-model="updateMobileNumbers"
            type="text"
            class="form-control"
            id="updateMobileNumbers"
            required
          />
        </div>

        <button type="submit" class="btn btn-primary">Update Supplier</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      suppliers: [],
      currentPage: 1,
      totalPages: 1,
      showUpdate: false,
      updateSupplierId: null,
      updateSupplierName: "",
      updateContactPerson: "",
      updateMobileNumbers: "",
      searchQuery: "",
    };
  },
  mounted() {
    this.fetchSuppliers();
  },
  methods: {
    fetchSuppliers() {
      const apiUrl =
        this.searchQuery !== ""
          ? `http://127.0.0.1:8000/api/search?q=${this.searchQuery}`
          : `http://127.0.0.1:8000/api/suppliers?page=${this.currentPage}`;

      axios
        .get(apiUrl)
        .then((response) => {
          this.suppliers = response.data.data;
          this.currentPage = response.data.current_page;
          this.totalPages = response.data.last_page;
        })
        .catch((error) => {
          console.error("Error fetching suppliers:", error);
        });
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage += 1;
        this.fetchSuppliers();
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage -= 1;
        this.fetchSuppliers();
      }
    },
    showUpdateForm(supplier) {
      this.showUpdate = true;
      this.updateSupplierId = supplier.id;
      this.updateSupplierName = supplier.name;
      this.updateContactPerson = supplier.contact_person;
      this.updateMobileNumbers = supplier.mobile_numbers;
    },
    updateSupplier() {
      const updatedSupplier = {
        id: this.updateSupplierId,
        name: this.updateSupplierName,
        contact_person: this.updateContactPerson,
        mobile_numbers: this.updateMobileNumbers,
      };

      axios
        .put(
          `http://127.0.0.1:8000/api/suppliers/${this.updateSupplierId}`,
          updatedSupplier
        )
        .then((response) => {
          this.fetchSuppliers();
          this.clearUpdateForm();
        })
        .catch((error) => {
          console.error("Error updating supplier:", error);
        });
    },
    clearUpdateForm() {
      this.showUpdate = false;
      this.updateSupplierId = null;
      this.updateSupplierName = "";
      this.updateContactPerson = "";
      this.updateMobileNumbers = "";
    },
    deleteSupplier(supplierId) {
      if (confirm("Are you sure you want to delete this supplier?")) {
        axios
          .delete(`http://127.0.0.1:8000/api/suppliers/${supplierId}`)
          .then((response) => {
            this.fetchSuppliers();
          })
          .catch((error) => {
            console.error("Error deleting supplier:", error);
          });
      }
    },
    search() {
      this.currentPage = 1;
      this.fetchSuppliers();
    },
  },
};
</script>
