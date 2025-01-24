<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CartModel;
use App\Models\ProductModel;

class CartController extends Controller
{
    protected $cartModel;
    protected $productModel;
    protected $session;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
        $this->session = session(); // Inisialisasi session
    }

    /**
     * Menambahkan produk ke dalam keranjang
     */
    public function addToCart($productId)
    {
        if (!$this->session->get('isLoggedIn')) {
            // Jika user belum login, redirect ke halaman login
            return redirect()->to('/login');
        }

        // Ambil data produk berdasarkan productId
        $product = $this->productModel->find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }

        // Ambil data kuantitas dari input (default 1 jika tidak ada input)
        $quantity = $this->request->getVar('quantity') ?: 1;

        // Data yang akan ditambahkan ke dalam cart
        $cartData = [
            'id_cart' => uniqid('CART'), // ID cart baru, bisa menggunakan uniqid
            'id_user' => $this->session->get('user_id'), // ID user dari session
            'id_product' => $productId,
            'quantity' => $quantity,
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Menambahkan item ke dalam cart
        $this->cartModel->addToCart($cartData);

        return redirect()->to('/cart'); // Kembali ke halaman cart
    }

    /**
     * Menampilkan halaman keranjang belanja
     */
    public function viewCart()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login'); // Redirect ke login jika user belum login
        }

        $userId = $this->session->get('user_id');
        $cartItems = $this->cartModel->getCartByUserId($userId); // Ambil item cart untuk user

        // Memasukkan data ke dalam view
        $data = [
            'isLoggedIn' => true,
            'cartItems' => $cartItems,
        ];

        return view('customer/cart', $data); // Ganti dengan nama view yang sesuai
    }

    /**
     * Mengupdate kuantitas produk dalam cart
     */
    public function updateCart($cartId)
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Ambil kuantitas baru dari input
        $quantity = $this->request->getVar('quantity');

        if ($quantity <= 0) {
            return redirect()->back()->with('error', 'Kuantitas harus lebih besar dari 0');
        }

        // Update kuantitas dalam cart
        $this->cartModel->updateQuantity($cartId, $quantity);

        return redirect()->to('/cart'); // Redirect kembali ke halaman cart
    }

    /**
     * Menghapus item dari keranjang
     */
    public function removeFromCart($cartId)
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Menghapus item dari cart
        $this->cartModel->removeFromCart($cartId);

        return redirect()->to('/cart'); // Kembali ke halaman cart
    }

    /**
     * Menghapus semua item dari keranjang
     */
    public function clearCart()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Menghapus semua item dalam cart
        $this->cartModel->clearCartByUserId($this->session->get('user_id'));

        return redirect()->to('/cart'); // Kembali ke halaman cart
    }
}
