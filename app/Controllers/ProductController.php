<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductModel; // Memuat model produk

class ProductController extends Controller
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel(); // Inisialisasi model produk
    }

    // Halaman untuk menampilkan semua produk
    public function index()
    {
        $products = $this->productModel->getAllProducts();
        return view('product/index', ['products' => $products]);
    }

    // Halaman untuk menambahkan produk baru
    public function create()
    {
        return view('product/create');
    }

    // Proses menambahkan produk
    public function store()
    {
        $data = [
            'id_product' => uniqid('prd_'), // Generate ID produk unik
            'product_name' => $this->request->getPost('product_name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->productModel->createProduct($data)) {
            return redirect()->to('/product')->with('success', 'Product created successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create product!');
        }
    }

    // Halaman untuk mengedit produk
    public function edit($id_product)
    {
        $product = $this->productModel->getProductById($id_product);
        return view('product/edit', ['product' => $product]);
    }

    // Proses memperbarui produk
    public function update($id_product)
    {
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($this->productModel->updateProduct($id_product, $data)) {
            return redirect()->to('/product')->with('success', 'Product updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update product!');
        }
    }

    // Proses menghapus produk
    public function delete($id_product)
    {
        if ($this->productModel->deleteProduct($id_product)) {
            return redirect()->to('/product')->with('success', 'Product deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to delete product!');
        }
    }
}
