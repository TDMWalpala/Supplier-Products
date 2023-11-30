
# Supplier Products System
The "Supplier Products" system is a Laravel-based web application for managing supplier details and associated products.

## Technologies Used
- [Laravel](https://laravel.com/)
- [Vue.js](https://vuejs.org/)
- [Bootstrap](https://getbootstrap.com/)

## Supplier Products API

This is a simple API for managing suppliers and their products using Laravel.

## Getting Started

### Prerequisites

Before you begin, make sure you have the following installed on your system:

- [PHP](https://www.php.net/) >= 8.2
- [Composer](https://getcomposer.org/)

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/TDMWalpala/Supplier-Products.git



Change into the project directory:

```bash
  cd supplier-products
  cd supplier_products api
```
Install PHP dependencies:

```bash
  composer install
```
Create a copy of the .env.example file and rename it to .env. Update the database and other configurations in the .env file:

```bash
  cp .env.example .env
```
Run migrations to create the necessary database tables:

```bash
  php artisan migrate
```
(Optional) Seed the database with sample data:

```bash
  php artisan db:seed
```
Start the Laravel development server:

```bash
  php artisan serve
```


### API Endpoints

##### Suppliers:
- GET /api/suppliers: Get a list of all suppliers.
- GET /api/suppliers/{id}: Get details of a specific supplier.
- GET /api/search/suppliers?q={name or mobile}: Search for suppliers based on criteria.
- POST /api/suppliers: Create a new supplier.
- PUT /api/suppliers/{id}: Update details of a specific supplier.
- DELETE /api/suppliers/{id}: Delete a specific supplier.

##### Products:

- GET /api/products: Get a list of all products.
- GET /api/products/{id}: Get details of a specific product.
- POST /api/products: Create a new product.
- PUT /api/products/{id}: Update details of a specific product.
- DELETE /api/products/{id}: Delete a specific product.

## Supplier Products Vue.js Frontend

Change into the frontend directory:

```bash
  cd supplier-products-frontend
```
Install Dependencies:

```bash
  npm install
```
Run Development Server

```bash
  npm run dev
```
