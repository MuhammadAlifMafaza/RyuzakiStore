<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CustomerModel;
use App\Models\OrderModel;
use App\Models\ProductModel;

class AdminController extends Controller
{
    public function dashboard()
    {
        
        // $customerModel = new CustomerModel();
        // $orderModel = new OrderModel();
        // $productModel = new ProductModel();

        // $data = [
        //     'total_customers' => $customerModel->countAll(),
        //     'total_orders' => $orderModel->countAll(),
        //     'total_products' => $productModel->countAll(),
        //     'monthly_revenue' => $orderModel->getMonthlyRevenue(),
        //     'order_stats' => $orderModel->getOrderStats(),
        //     'latest_products' => $productModel->orderBy('created_at', 'DESC')->findAll(5),
        //     'chart_data' => json_encode($orderModel->getMonthlyRevenue()),
        //     'order_status_chart' => json_encode($orderModel->getOrderStats()),
        // ];

        // return view('admin/dashboard', $data);

        return view('admin/dashboard'); // Dashboard admin
    }

    public function settings()
    {
        return view('admin/settings'); // Halaman pengaturan admin
    }

    public function users()
    {
        return view('admin/users'); // Halaman manajemen pengguna
    }
}
