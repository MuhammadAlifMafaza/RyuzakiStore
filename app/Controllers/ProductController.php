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

    // menampilkan data product di halaman pelanggan(home)
    public function tampilDetail($id_product)
    {
        $session = session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/customerAuth/login');
        }

        $productModel = new ProductModel();
        $product = $productModel->where('id_product', $id_product)->first();

        // Jika produk tidak ditemukan, redirect ke halaman produk dengan pesan error
        if (!$product) {
            return redirect()->to('/products')->with('error', 'Produk tidak ditemukan!');
        }

        return view('home/detail_product', ['product' => $product]);
    }

    // Mengelola data produk admin
    public function indexByAdmin()
    {
        $data['products'] = $this->productModel->findAll();
        return view('admin/products/index', $data);  // Path yang benar
    }

    public function createByAdmin()
    {
        return view('admin/products/create');  // Path yang benar
    }

    public function storeByAdmin()
    {
        $validationRules = [
            'product_name' => 'required|min_length[3]|max_length[255]',
            'category' => 'required',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid!');
        }

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
            return redirect()->to('/admin/product-list')->with('success', 'Product created successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create product!');
        }
    }

    public function editByAdmin($id_product)
    {
        $product = $this->productModel->find($id_product);
        return view('admin/products/update', ['product' => $product]);  // Path yang benar
    }

    public function updateByAdmin($id_product)
    {
        // Validasi input selain gambar
        $validationRules = [
            'product_name'   => 'required|min_length[3]|max_length[255]',
            'category'       => 'required',
            'price'          => 'required|numeric',
            'stock_quantity' => 'required|integer',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid!');
        }

        $product = $this->productModel->find($id_product);
        $file    = $this->request->getFiles();

        // Inisialisasi variabel untuk menyimpan path gambar yang akan digunakan
        $updatedImagePaths = $product['image']; // default: gunakan data gambar yang sudah ada

        // Cek apakah ada file gambar baru yang diunggah
        if (!empty($file['images'])) {
            // Kita asumsikan field "images" adalah array. Cek apakah file pertama ada dan tidak error.
            // Kode Error 4 biasanya berarti "No file was uploaded"
            if (isset($file['images'][0]) && $file['images'][0]->getError() !== 4) {
                // Jika ada gambar baru, kita hapus gambar lama (opsional, sesuaikan kebutuhan)
                $oldImages = explode(',', $product['image']);
                foreach ($oldImages as $oldImage) {
                    // Pastikan oldImage tidak kosong
                    $oldImage = trim($oldImage);
                    if (!empty($oldImage)) {
                        $oldImagePath = FCPATH . $oldImage;
                        // Pastikan file benar-benar ada dan merupakan file (bukan direktori)
                        if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                }

                // Upload gambar baru
                $newImagePaths = [];
                foreach ($file['images'] as $img) {
                    if ($img->isValid() && !$img->hasMoved()) {
                        $newName    = $img->getRandomName();
                        $uploadPath = FCPATH . 'uploads/img/products/'; // Pastikan path sudah sesuai
                        if (!is_dir($uploadPath)) {
                            mkdir($uploadPath, 0777, true);
                        }
                        $img->move($uploadPath, $newName);
                        $newImagePaths[] = 'uploads/img/products/' . $newName;
                    }
                }
                // Gabungkan path gambar baru menjadi string, misal dipisahkan dengan koma
                $updatedImagePaths = implode(',', $newImagePaths);
            }
        }

        $data = [
            'product_name'   => $this->request->getPost('product_name'),
            'category'       => $this->request->getPost('category'),
            'tags'           => $this->request->getPost('tags'),
            'description'    => $this->request->getPost('description'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            // Jika ada gambar baru, gunakan gambar baru; jika tidak, tetap gunakan gambar lama.
            'image'          => $updatedImagePaths,
            'updated_at'     => date('Y-m-d H:i:s')
        ];

        if ($this->productModel->update($id_product, $data)) {
            return redirect()->to('/admin/product-list')->with('success', 'Product updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update product!');
        }
    }

    public function deleteByAdmin($id)
    {
        $productModel = new \App\Models\ProductModel();

        if ($productModel->deleteProduct($id)) {
            return redirect()->to('/products')->with('success', 'Product deleted successfully.');
        } else {
            return redirect()->to('/products')->with('error', 'Product not found.');
        }
    }

    public function showByAdmin($id_product)
    {
        $data['product'] = $this->productModel->find($id_product);
        return view('admin/products/detail', $data);  // Path yang benar
    }

    public function indexByOwner()
    {
        // Mendapatkan semua produk untuk owner
        $data['products'] = $this->productModel->findAll();
        return view('owner/products/index', $data);  // Path yang benar
    }

    public function createByOwner()
    {
        // Menampilkan form untuk menambah produk
        return view('owner/products/create');  // Path yang benar
    }

    public function storeByOwner()
    {
        $validationRules = [
            'product_name' => 'required|min_length[3]|max_length[255]',
            'category' => 'required',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid!');
        }

        $file = $this->request->getFiles();
        $imagePaths = [];

        if (!empty($file['images'])) {
            foreach ($file['images'] as $img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $uploadPath = FCPATH . 'uploads/img/products/';
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0777, true);
                    }

                    $img->move($uploadPath, $newName);
                    $imagePaths[] = 'uploads/img/products/' . $newName;
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
            return redirect()->to('/owner/product-list')->with('success', 'Product created successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create product!');
        }
    }

    public function editByOwner($id_product)
    {
        $product = $this->productModel->find($id_product);
        return view('owner/products/update', ['product' => $product]);  // Path yang benar
    }

    public function updateByOwner($id_product)
    {
        $validationRules = [
            'product_name'   => 'required|min_length[3]|max_length[255]',
            'category'       => 'required',
            'price'          => 'required|numeric',
            'stock_quantity' => 'required|integer',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid!');
        }

        $product = $this->productModel->find($id_product);
        $file = $this->request->getFiles();

        $updatedImagePaths = $product['image']; // Gunakan gambar lama jika tidak ada gambar baru

        if (!empty($file['images'])) {
            if (isset($file['images'][0]) && $file['images'][0]->getError() !== 4) {
                // Menghapus gambar lama jika ada gambar baru
                $oldImages = explode(',', $product['image']);
                foreach ($oldImages as $oldImage) {
                    $oldImagePath = FCPATH . $oldImage;
                    if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Upload gambar baru
                $newImagePaths = [];
                foreach ($file['images'] as $img) {
                    if ($img->isValid() && !$img->hasMoved()) {
                        $newName = $img->getRandomName();
                        $uploadPath = FCPATH . 'uploads/img/products/';
                        if (!is_dir($uploadPath)) {
                            mkdir($uploadPath, 0777, true);
                        }
                        $img->move($uploadPath, $newName);
                        $newImagePaths[] = 'uploads/img/products/' . $newName;
                    }
                }
                $updatedImagePaths = implode(',', $newImagePaths);
            }
        }

        $data = [
            'product_name'   => $this->request->getPost('product_name'),
            'category'       => $this->request->getPost('category'),
            'tags'           => $this->request->getPost('tags'),
            'description'    => $this->request->getPost('description'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image'          => $updatedImagePaths,
            'updated_at'     => date('Y-m-d H:i:s')
        ];

        if ($this->productModel->update($id_product, $data)) {
            return redirect()->to('/owner/product-list')->with('success', 'Product updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update product!');
        }
    }

    public function deleteByOwner($id)
    {
        if ($this->productModel->delete($id)) {
            return redirect()->to('/owner/product-list')->with('success', 'Product deleted successfully.');
        } else {
            return redirect()->to('/owner/product-list')->with('error', 'Product not found.');
        }
    }

    public function showByOwner($id_product)
    {
        $data['product'] = $this->productModel->find($id_product);
        return view('owner/products/detail', $data);  // Path yang benar
    }
}
