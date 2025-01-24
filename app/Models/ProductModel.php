<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products'; // Nama tabel produk
    protected $primaryKey = 'id_product'; // Primary key untuk tabel produk
    protected $allowedFields = [
        'id_product',
        'product_name',
        'description',
        'image',
        'price',
        'stock_quantity',
        'created_at',
        'updated_at'
    ]; // Kolom yang diizinkan untuk diinput

    protected $useTimestamps = true; // Mengaktifkan penggunaan timestamps untuk created_at dan updated_at

    // Menambahkan validasi data produk
    protected $validationRules = [
        'product_name' => 'required|min_length[3]|max_length[255]',
        'price' => 'required|decimal',
        'stock_quantity' => 'required|integer',
    ];

    protected $validationMessages = [
        'product_name' => [
            'required' => 'Product name is required.',
            'min_length' => 'Product name must be at least 3 characters.',
            'max_length' => 'Product name cannot exceed 255 characters.',
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

    // Menambahkan fungsi untuk mengambil semua produk
    public function getAllProducts()
    {
        return $this->findAll();
    }

    // Menambahkan fungsi untuk mengambil produk berdasarkan ID
    public function getProductById($id_product)
    {
        return $this->find($id_product);
    }

    // Menambahkan fungsi untuk menambahkan produk baru
    public function createProduct($data)
    {
        return $this->insert($data);
    }

    // Menambahkan fungsi untuk memperbarui produk berdasarkan ID
    public function updateProduct($id_product, $data)
    {
        return $this->update($id_product, $data);
    }

    // Menambahkan fungsi untuk menghapus produk berdasarkan ID
    public function deleteProduct($id_product)
    {
        return $this->delete($id_product);
    }
}
