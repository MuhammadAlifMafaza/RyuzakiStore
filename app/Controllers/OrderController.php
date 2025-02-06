<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\ProductModel;

class OrderController extends Controller
{
    protected $orderModel;
    protected $orderItemModel;
    protected $productModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $session = session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/customerAuth/login');
        }
        return view('home\checkout.php');
    }
    /**
     * Membuat order baru
     */
    public function createOrder()
    {
        $session = session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/customerAuth/login');
        }
        $userId = $session->get('user_id'); // Mendapatkan user_id dari session
        $orderData = [
            'id_order' => uniqid('ORD'), // ID order baru, bisa menggunakan uniqid
            'id_user' => $userId,
            'order_date' => date('Y-m-d H:i:s'),
            'status' => 'pending', // Status order dimulai dengan 'pending'
            'total_amount' => 0, // Total amount akan dihitung nanti
        ];

        // Membuat order baru
        $orderId = $this->orderModel->createOrder($orderData);

        // Mengambil produk yang dipilih oleh user
        $cartItems = $this->getCartItemsByUserId($userId); // Mengambil data dari cart

        $totalAmount = 0;

        // Menambahkan item ke dalam order
        foreach ($cartItems as $cartItem) {
            $product = $this->productModel->find($cartItem['id_product']);
            $orderItemData = [
                'id_order_item' => uniqid('OI'), // ID order item
                'id_order' => $orderId,
                'id_product' => $cartItem['id_product'],
                'quantity' => $cartItem['quantity'],
                'price' => $product['price'],
            ];

            // Menambahkan item ke order
            $this->orderItemModel->addOrderItem($orderItemData);

            // Menghitung total amount
            $totalAmount += $cartItem['quantity'] * $product['price'];
        }

        // Mengupdate total amount di order
        $this->orderModel->updateOrderStatus($orderId, ['total_amount' => $totalAmount]);

        // Menghapus item dari cart setelah order selesai
        $this->clearCart($userId);

        return redirect()->to('/order/' . $orderId); // Redirect ke halaman order detail
    }

    /**
     * Mengambil item dari cart berdasarkan user_id
     */
    private function getCartItemsByUserId($userId)
    {
        $session = session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/customerAuth/login');
        }
        // Mengambil data cart yang relevan, menggunakan CartModel
        $cartModel = new \App\Models\CartModel();
        return $cartModel->getCartByUserId($userId);
    }

    /**
     * Menghapus item dari cart setelah order dibuat
     */
    private function clearCart($userId)
    {
        $session = session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/customerAuth/login');
        }
        $cartModel = new \App\Models\CartModel();
        $cartItems = $cartModel->getCartByUserId($userId);

        foreach ($cartItems as $cartItem) {
            $cartModel->deleteCartItem($cartItem['id_cart']);
        }
    }
}
