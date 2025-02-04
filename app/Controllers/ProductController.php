<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductModel;

class ProductController extends Controller
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data['products'] = $this->productModel->findAll();
        return view('/products/index', $data);
    }

    public function create()
    {
        return view('/products/create');
    }

    public function store()
    {
        $file = $this->request->getFiles();
        $imagePaths = [];

        if (!empty($file['images'])) {
            foreach ($file['images'] as $img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $uploadPath = FCPATH . 'uploads/img/products/'; // Path absolut
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0777, true); // Buat folder jika belum ada
                    }

                    $img->move($uploadPath, $newName);
                    $imagePaths[] = 'uploads/img/products/' . $newName; // Simpan path relatif
                }
            }
        }

        $data = [
            'id_product' => uniqid('prd_'),
            'product_name' => $this->request->getPost('product_name'),
            'category' => $this->request->getPost('category'),
            'tags' => $this->request->getPost('tags'),
            'description' => $this->request->getPost('description'),
            'image' => implode(',', $imagePaths),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->productModel->insert($data)) {
            return redirect()->to('/product-list')->with('success', 'Product created successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create product!');
        }
    }

    public function edit($id_product)
    {
        $product = $this->productModel->find($id_product);
        return view('/products/update', ['product' => $product]);
    }

    public function update($id_product)
    {
        $product = $this->productModel->find($id_product);
        $file = $this->request->getFiles();
        $imagePaths = explode(',', $product['image']); // Ambil gambar lama

        if (!empty($file['images'])) {
            foreach ($file['images'] as $img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $img->move(FCPATH . 'uploads/img/', $newName);
                    $imagePaths[] = 'uploads/img/' . $newName;
                }
            }
        }

        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'category' => $this->request->getPost('category'),
            'tags' => $this->request->getPost('tags'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image' => implode(',', $imagePaths), // Gabungkan gambar baru + lama
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($this->productModel->update($id_product, $data)) {
            return redirect()->to('/product-list')->with('success', 'Product updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update product!');
        }
    }

    public function delete($id_product)
    {
        // Check if the form method is POST and if the hidden '_method' is set to 'DELETE'
        if ($this->request->getMethod() === 'post' && $this->request->getPost('_method') === 'DELETE') {
            if ($this->productModel->delete($id_product)) {
                return redirect()->to('/product-list')->with('success', 'Product deleted successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to delete product!');
            }
        }

        // If method is not POST or '_method' is not DELETE
        return redirect()->back()->with('error', 'Invalid request method!');
    }


    public function show($id_product)
    {
        $data['product'] = $this->productModel->find($id_product);
        return view('/products/detail', $data);
    }
}
