<!-- HomePage.vue -->

<template>
    <div>
      <h2>Welcome to the Supplier Products System</h2>
  
      <router-link to="/add-supplier">
        <button>Add Supplier</button>
      </router-link>
  
      <router-link to="/view-suppliers">
        <button>View Suppliers</button>
      </router-link>
  
      <router-link to="/view-products">
        <button>View Products</button>
      </router-link>
    </div>
  </template>
  
  <script>
  export default {
    
  };
  </script>
  