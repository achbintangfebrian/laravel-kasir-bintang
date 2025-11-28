# Smart Cashier (Kasir Cerdas) API Documentation

This document provides an overview of the Laravel backend API for the Smart Cashier application with AI Product Recommendations.

## Base URL
```
http://localhost:8000/api/v1
```

## Authentication

### Register
```
POST /auth/register
```

**Request Body:**
```json
{
  "role": 1,
  "email": "admin@example.com",
  "password": "password123"
}
```

### Login
```
POST /auth/login
```

**Request Body:**
```json
{
  "email": "admin@example.com",
  "password": "password123"
}
```

## Products

### Get All Products
```
GET /products
```

### Get Product by ID
```
GET /products/{id}
```

### Create Product
```
POST /products
```

**Request Body:**
```json
{
  "nama": "Product Name",
  "harga": 10000,
  "stok": 50,
  "kategori_id": 1,
  "image": "product_image.jpg"
}
```

### Update Product
```
PUT /products/{id}
```

**Request Body:**
```json
{
  "nama": "Updated Product Name",
  "harga": 15000,
  "stok": 30,
  "kategori_id": 1,
  "image": "updated_product_image.jpg"
}
```

### Delete Product
```
DELETE /products/{id}
```

## Categories

### Get All Categories
```
GET /categories
```

### Get Category by ID
```
GET /categories/{id}
```

### Create Category
```
POST /categories
```

**Request Body:**
```json
{
  "name": "Category Name"
}
```

### Update Category
```
PUT /categories/{id}
```

**Request Body:**
```json
{
  "name": "Updated Category Name"
}
```

### Delete Category
```
DELETE /categories/{id}
```

## Transactions

### Get All Transactions
```
GET /transactions
```

### Get Transaction by ID
```
GET /transactions/{id}
```

### Create Transaction
```
POST /transactions
```

**Request Body:**
```json
{
  "user_id": 1,
  "opsi_pay": "Cash",
  "items": [
    {
      "produk_id": 1,
      "jumlah_item": 2,
      "harga_peritem": 10000,
      "subtotal": 20000
    }
  ]
}
```

### Delete Transaction
```
DELETE /transactions/{id}
```

## AI Recommendations

### Get Recommendations
```
GET /recommendations
```

**Query Parameters:**
- `user_id` (optional): Get personalized recommendations for a specific user

### Log Recommendation
```
POST /recommendations
```

**Request Body:**
```json
{
  "user_id": 1,
  "produk_id": 1,
  "action": 1,
  "bbot_rekom": 1
}
```

## Database Schema

The application uses the following database tables:

1. `admin` - Store administrator accounts
2. `kategori_produk` - Product categories
3. `produk` - Product information
4. `rekom_ai` - AI recommendation logs
5. `transaksi_kasir` - Cashier transactions
6. `transaksi_item` - Items in transactions

## Models

The application includes the following Eloquent models:

1. `Admin` - Administrator accounts
2. `KategoriProduk` - Product categories
3. `Produk` - Products
4. `RekomAi` - AI recommendation logs
5. `TransaksiKasir` - Cashier transactions
6. `TransaksiItem` - Transaction items

## Controllers

The application includes the following API controllers:

1. `AuthController` - Handle authentication
2. `ProdukController` - Manage products
3. `KategoriProdukController` - Manage categories
4. `TransaksiController` - Manage transactions
5. `RekomendasiController` - Handle AI recommendations

## Resources

The application includes the following API resources for data transformation:

1. `AdminResource` - Transform Admin model data
2. `KategoriProdukResource` - Transform KategoriProduk model data
3. `ProdukResource` - Transform Produk model data
4. `TransaksiItemResource` - Transform TransaksiItem model data
5. `TransaksiKasirResource` - Transform TransaksiKasir model data

## Features Implemented

1. **Point of Sale System**
   - Add products to cart
   - Edit purchase quantities
   - Automatic total calculation
   - Print/save receipt as PDF
   - Transaction history

2. **Product Management**
   - Add new products
   - Edit products
   - Delete products
   - Upload product images
   - Product categories
   - Automatic stock reduction after transactions

3. **AI Product Recommendations**
   - Recommendations based on user purchase history
   - Content-based recommendations (similar categories)
   - Frequency-based recommendations (most sold products)
   - Recommendations appear when opening app, adding first product, and after transactions

4. **User Login & Management**
   - Admin/cashier login
   - Role-based access (Admin/Staff)

5. **Sales Dashboard**
   - Daily/weekly/monthly statistics
   - Sales charts
   - Most purchased products
   - Total revenue

6. **Stock Management**
   - Stock increases when restocking
   - Stock decreases during transactions
   - Low stock notifications
   - Daily stock reports

7. **Product Categories**
   - Create new categories
   - Assign categories to products
   - Filter products by category