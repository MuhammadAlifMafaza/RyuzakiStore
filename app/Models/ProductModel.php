<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products'; // Table name
    protected $primaryKey = 'id_product'; // Primary key of the table
    protected $allowedFields = [
        'id_product', 'product_name', 'category', 'tags', 'description',
        'image', 'price', 'stock_quantity', 'created_at', 'updated_at',
    ];

    protected $useTimestamps = true; // Enable timestamps for created_at and updated_at

    // Validation rules for product data
    protected $validationRules = [
        'product_name' => 'required|min_length[3]|max_length[255]',
        'category' => 'in_list[Atasan Pria,Atasan Wanita,Bawahan Pria,Bawahan Wanita]', // Enum validation
        'tags' => 'permit_empty', // Can be empty
        'price' => 'required|decimal',
        'stock_quantity' => 'required|integer',
    ];

    protected $validationMessages = [
        'product_name' => [
            'required' => 'Product name is required.',
            'min_length' => 'Product name must be at least 3 characters.',
            'max_length' => 'Product name cannot exceed 255 characters.',
        ],
        'category' => [
            'in_list' => 'Category must be one of the following: Atasan Pria, Atasan Wanita, Bawahan Pria, Bawahan Wanita.',
        ],
        'price' => [
            'required' => 'Price is required.',
            'decimal' => 'Price must be a valid decimal number.',
        ],
        'stock_quantity' => [
            'required' => 'Stock quantity is required.',
            'integer' => 'Stock quantity must be an integer.',
        ],
    ];

    // function search product
    public function searchProducts($keyword = null, $category = null)
    {
        $builder = $this->table($this->table);

        if (!empty($keyword)) {
            $builder->like('product_name', $keyword);
        }

        if (!empty($category) && $category !== 'all') {
            $builder->where('category', $category);
        }

        return $builder->get()->getResultArray();
    }

    // Function to fetch all products
    public function getAllProducts()
    {
        return $this->findAll();
    }

    // Function to fetch product by ID
    public function getProductById($id_product)
    {
        return $this->find($id_product);
    }

    // Function to insert a new product
    public function createProduct($data)
    {
        return $this->insert($data);
    }

    // Function to update product by ID
    public function updateProduct($id_product, $data)
    {
        return $this->update($id_product, $data);
    }

    // Function untuk delete product by ID
    public function deleteProduct($id)
    {
        // melakukan cek data apabila data ada
        $product = $this->find($id);
        if (!$product) {
            return false; // Product tidak ditemukan
        }

        // Menghapus data product
        return $this->delete($id);
    }
}
