import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SupplierList from '../components/SupplierList.vue'
import ProductList from '../components/ProductList.vue'
import SupplierAddForm from '../components/SupplierAddForm.vue'
import ProductAddForm from '../components/ProductAddForm.vue';
import SupplierSearch from '../components/SearchComponent.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/view-suppliers',
      name: 'view-suppliers',
      component: SupplierList
    },
    {
      path: '/view-products',
      name: 'view-products',
      component: ProductList
    },
    {
      path: '/add-supplier',
      name: 'add-supplier',
      component: SupplierAddForm
    }
    ,
    {
      path: '/add-product/:supplierId',
      name: 'add-product',
      component: ProductAddForm,
      props: true,
    },
    {
      path: '/search-supplier', 
      name: 'search-supplier',
      component: SupplierSearch, 
    },
    
  ]
})

export default router
