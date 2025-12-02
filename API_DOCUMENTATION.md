# Smart Cashier API Documentation

## Overview
This documentation covers the RESTful API for the Smart Cashier application with AI-powered product recommendations. The API provides endpoints for managing products, categories, customers, and transactions.

## Base URL
```
http://localhost:8000/api/v1
```

## Authentication
Currently, the API does not require authentication for any endpoints.

## Response Format
All API responses follow this standard format:
```json
{
  "success": true/false,
  "message": "Description of the operation result",
  "data": {} // or []
}
```

---

## Categories

### Get All Categories
**GET** `/categories`

Retrieves all product categories.

**Response:**
```json
{
  "success": true,
  "message": "Categories retrieved successfully",
  "data": [
    {
      "id": 1,
      "name": "Electronics",
      "created_at": "2025-12-02T03:43:04.000000Z",
      "updated_at": "2025-12-02T03:43:04.000000Z"
    }
  ]
}
```

### Create Category
**POST** `/categories`

Creates a new product category.

**Request Body:**
```json
{
  "name": "Books"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Category created successfully",
  "data": {
    "id": 2,
    "name": "Books",
    "created_at": "2025-12-02T04:15:22.000000Z",
    "updated_at": "2025-12-02T04:15:22.000000Z"
  }
}
```

### Get Category
**GET** `/categories/{id}`

Retrieves a specific category by ID.

**Response:**
```json
{
  "success": true,
  "message": "Category retrieved successfully",
  "data": {
    "id": 1,
    "name": "Electronics",
    "created_at": "2025-12-02T03:43:04.000000Z",
    "updated_at": "2025-12-02T03:43:04.000000Z"
  }
}
```

### Update Category
**PUT** `/categories/{id}`

Updates an existing category.

**Request Body:**
```json
{
  "name": "Home & Garden"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Category updated successfully",
  "data": {
    "id": 1,
    "name": "Home & Garden",
    "created_at": "2025-12-02T03:43:04.000000Z",
    "updated_at": "2025-12-02T04:20:10.000000Z"
  }
}
```

### Delete Category
**DELETE** `/categories/{id}`

Deletes a category.

**Response:**
```json
{
  "success": true,
  "message": "Category deleted successfully"
}
```

---

## Products

### Get All Products
**GET** `/products`

Retrieves all products with their categories.

**Response:**
```json
{
  "success": true,
  "message": "Products retrieved successfully",
  "data": [
    {
      "id": 1,
      "name": "Smartphone XYZ",
      "price": 5000000,
      "stock": 25,
      "category_id": 1,
      "created_at": "2025-12-02T03:45:30.000000Z",
      "updated_at": "2025-12-02T03:45:30.000000Z",
      "category": {
        "id": 1,
        "name": "Electronics",
        "created_at": "2025-12-02T03:43:04.000000Z",
        "updated_at": "2025-12-02T03:43:04.000000Z"
      }
    }
  ]
}
```

### Create Product
**POST** `/products`

Creates a new product.

**Request Body:**
```json
{
  "name": "Laptop ABC",
  "price": 12000000,
  "stock": 10,
  "category_id": 1
}
```

**Response:**
```json
{
  "success": true,
  "message": "Product created successfully",
  "data": {
    "id": 2,
    "name": "Laptop ABC",
    "price": 12000000,
    "stock": 10,
    "category_id": 1,
    "created_at": "2025-12-02T04:30:15.000000Z",
    "updated_at": "2025-12-02T04:30:15.000000Z",
    "category": {
      "id": 1,
      "name": "Electronics",
      "created_at": "2025-12-02T03:43:04.000000Z",
      "updated_at": "2025-12-02T03:43:04.000000Z"
    }
  }
}
```

### Get Product
**GET** `/products/{id}`

Retrieves a specific product by ID.

**Response:**
```json
{
  "success": true,
  "message": "Product retrieved successfully",
  "data": {
    "id": 1,
    "name": "Smartphone XYZ",
    "price": 5000000,
    "stock": 25,
    "category_id": 1,
    "created_at": "2025-12-02T03:45:30.000000Z",
    "updated_at": "2025-12-02T03:45:30.000000Z",
    "category": {
      "id": 1,
      "name": "Electronics",
      "created_at": "2025-12-02T03:43:04.000000Z",
      "updated_at": "2025-12-02T03:43:04.000000Z"
    }
  }
}
```

### Update Product
**PUT** `/products/{id}`

Updates an existing product.

**Request Body:**
```json
{
  "name": "Smartphone XYZ Pro",
  "price": 5500000,
  "stock": 20,
  "category_id": 1
}
```

**Response:**
```json
{
  "success": true,
  "message": "Product updated successfully",
  "data": {
    "id": 1,
    "name": "Smartphone XYZ Pro",
    "price": 5500000,
    "stock": 20,
    "category_id": 1,
    "created_at": "2025-12-02T03:45:30.000000Z",
    "updated_at": "2025-12-02T04:35:45.000000Z",
    "category": {
      "id": 1,
      "name": "Electronics",
      "created_at": "2025-12-02T03:43:04.000000Z",
      "updated_at": "2025-12-02T03:43:04.000000Z"
    }
  }
}
```

### Delete Product
**DELETE** `/products/{id}`

Deletes a product.

**Response:**
```json
{
  "success": true,
  "message": "Product deleted successfully"
}
```

---

## Customers

### Get All Customers
**GET** `/customers`

Retrieves all customers.

**Response:**
```json
{
  "success": true,
  "message": "Customers retrieved successfully",
  "data": [
    {
      "id": 1,
      "name": "John Doe",
      "phone": "081234567890",
      "created_at": "2025-12-02T03:50:20.000000Z",
      "updated_at": "2025-12-02T03:50:20.000000Z"
    }
  ]
}
```

### Create Customer
**POST** `/customers`

Creates a new customer.

**Request Body:**
```json
{
  "name": "Jane Smith",
  "phone": "082345678901"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Customer created successfully",
  "data": {
    "id": 2,
    "name": "Jane Smith",
    "phone": "082345678901",
    "created_at": "2025-12-02T04:40:30.000000Z",
    "updated_at": "2025-12-02T04:40:30.000000Z"
  }
}
```

### Get Customer
**GET** `/customers/{id}`

Retrieves a specific customer by ID.

**Response:**
```json
{
  "success": true,
  "message": "Customer retrieved successfully",
  "data": {
    "id": 1,
    "name": "John Doe",
    "phone": "081234567890",
    "created_at": "2025-12-02T03:50:20.000000Z",
    "updated_at": "2025-12-02T03:50:20.000000Z"
  }
}
```

### Update Customer
**PUT** `/customers/{id}`

Updates an existing customer.

**Request Body:**
```json
{
  "name": "John Doe Jr.",
  "phone": "081234567890"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Customer updated successfully",
  "data": {
    "id": 1,
    "name": "John Doe Jr.",
    "phone": "081234567890",
    "created_at": "2025-12-02T03:50:20.000000Z",
    "updated_at": "2025-12-02T04:45:10.000000Z"
  }
}
```

### Delete Customer
**DELETE** `/customers/{id}`

Deletes a customer.

**Response:**
```json
{
  "success": true,
  "message": "Customer deleted successfully"
}
```

---

## Transactions

### Get All Transactions
**GET** `/transactions`

Retrieves all transactions with customer and item details.

**Response:**
```json
{
  "success": true,
  "message": "Transactions retrieved successfully",
  "data": [
    {
      "id": 1,
      "customer_id": 1,
      "total": 5000000,
      "created_at": "2025-12-02T04:00:15.000000Z",
      "updated_at": "2025-12-02T04:00:15.000000Z",
      "customer": {
        "id": 1,
        "name": "John Doe",
        "phone": "081234567890",
        "created_at": "2025-12-02T03:50:20.000000Z",
        "updated_at": "2025-12-02T03:50:20.000000Z"
      },
      "items": [
        {
          "id": 1,
          "transaction_id": 1,
          "product_id": 1,
          "quantity": 1,
          "price": 5000000,
          "subtotal": 5000000,
          "created_at": "2025-12-02T04:00:15.000000Z",
          "updated_at": "2025-12-02T04:00:15.000000Z",
          "product": {
            "id": 1,
            "name": "Smartphone XYZ",
            "price": 5000000,
            "stock": 24,
            "category_id": 1,
            "created_at": "2025-12-02T03:45:30.000000Z",
            "updated_at": "2025-12-02T04:00:15.000000Z"
          }
        }
      ]
    }
  ]
}
```

### Create Transaction
**POST** `/transactions`

Creates a new transaction with items.

**Request Body:**
```json
{
  "customer_id": 1,
  "items": [
    {
      "product_id": 1,
      "quantity": 2,
      "price": 5000000,
      "subtotal": 10000000
    }
  ]
}
```

**Response:**
```json
{
  "success": true,
  "message": "Transaction created successfully",
  "data": {
    "id": 2,
    "customer_id": 1,
    "total": 10000000,
    "created_at": "2025-12-02T04:50:20.000000Z",
    "updated_at": "2025-12-02T04:50:20.000000Z",
    "customer": {
      "id": 1,
      "name": "John Doe",
      "phone": "081234567890",
      "created_at": "2025-12-02T03:50:20.000000Z",
      "updated_at": "2025-12-02T03:50:20.000000Z"
    },
    "items": [
      {
        "id": 2,
        "transaction_id": 2,
        "product_id": 1,
        "quantity": 2,
        "price": 5000000,
        "subtotal": 10000000,
        "created_at": "2025-12-02T04:50:20.000000Z",
        "updated_at": "2025-12-02T04:50:20.000000Z",
        "product": {
          "id": 1,
          "name": "Smartphone XYZ",
          "price": 5000000,
          "stock": 22,
          "category_id": 1,
          "created_at": "2025-12-02T03:45:30.000000Z",
          "updated_at": "2025-12-02T04:50:20.000000Z"
        }
      }
    ]
  }
}
```

### Get Transaction
**GET** `/transactions/{id}`

Retrieves a specific transaction by ID.

**Response:**
```json
{
  "success": true,
  "message": "Transaction retrieved successfully",
  "data": {
    "id": 1,
    "customer_id": 1,
    "total": 5000000,
    "created_at": "2025-12-02T04:00:15.000000Z",
    "updated_at": "2025-12-02T04:00:15.000000Z",
    "customer": {
      "id": 1,
      "name": "John Doe",
      "phone": "081234567890",
      "created_at": "2025-12-02T03:50:20.000000Z",
      "updated_at": "2025-12-02T03:50:20.000000Z"
    },
    "items": [
      {
        "id": 1,
        "transaction_id": 1,
        "product_id": 1,
        "quantity": 1,
        "price": 5000000,
        "subtotal": 5000000,
        "created_at": "2025-12-02T04:00:15.000000Z",
        "updated_at": "2025-12-02T04:00:15.000000Z",
        "product": {
          "id": 1,
          "name": "Smartphone XYZ",
          "price": 5000000,
          "stock": 24,
          "category_id": 1,
          "created_at": "2025-12-02T03:45:30.000000Z",
          "updated_at": "2025-12-02T04:00:15.000000Z"
        }
      }
    ]
  }
}
```

### Delete Transaction
**DELETE** `/transactions/{id}`

Deletes a transaction and its items.

**Response:**
```json
{
  "success": true,
  "message": "Transaction deleted successfully"
}
```

---

## Recommendations

### Get Product Recommendations
**GET** `/recommendations`

Retrieves the top 3 best-selling products as recommendations.

**Response:**
```json
{
  "success": true,
  "message": "Recommendations retrieved successfully",
  "data": [
    {
      "id": 1,
      "name": "Smartphone XYZ",
      "price": 5000000,
      "stock": 24,
      "category_id": 1,
      "created_at": "2025-12-02T03:45:30.000000Z",
      "updated_at": "2025-12-02T04:00:15.000000Z"
    }
  ]
}
```

---

## Error Responses

All error responses follow this format:
```json
{
  "success": false,
  "message": "Error description"
}
```

Common HTTP status codes:
- **404 Not Found** - Resource doesn't exist
- **422 Unprocessable Entity** - Validation errors
- **500 Internal Server Error** - Server errors

Example validation error:
```json
{
  "success": false,
  "message": "The name field is required."
}
```

Example not found error:
```json
{
  "success": false,
  "message": "Product not found"
}
```