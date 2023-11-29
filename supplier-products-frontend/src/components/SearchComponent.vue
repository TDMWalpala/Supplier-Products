<!-- SearchComponent.vue -->

<template>
    <div class="container mt-5">
      <div class="input-group mb-3">
        <input v-model="searchQuery" type="text" class="form-control" placeholder="Enter search query" />
        <button @click="search" class="btn btn-primary">Search</button>
      </div>
      <ul class="list-group">
        <li v-for="result in searchResults" :key="result.id" class="list-group-item">
          {{ result.name }} - {{ result.contact_person }} - {{ result.mobile_numbers }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        searchQuery: '',
        searchResults: [],
      };
    },
    methods: {
      search() {
        axios.get(`http://127.0.0.1:8000/api/suppliers/search?q=${this.searchQuery}`)
          .then(response => {
            this.searchResults = response.data;
          })
          .catch(error => {
            console.error('Error searching:', error);
          });
      },
    },
  };
  </script>
  
  <style>
  </style>
  