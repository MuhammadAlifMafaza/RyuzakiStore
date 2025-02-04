<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CustomerModel;

class CustomerController extends Controller
{
    protected $session;
    protected $CustomerModel;

    public function __construct()
    {
        $this->session = session();
        $this->CustomerModel = new CustomerModel();
    }

    public function index(){
        return view('\home\home');
    }
    public function products(){
        return view('\home\product');
    }
    public function profile()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $customerId = $this->session->get('id_customer');

        // Fetch user and customer details
        $user = $this->CustomerModel->find($customerId);
        $customerDetails = $this->CustomerModel->getCustomerDetails($customerId);

        // Combine the user data and details for the view
        $data = [
            'isLoggedIn' => true,
            'user' => $user,
            'customerDetails' => $customerDetails,
        ];

        return view('home/profile', $data);
    }

    public function updateProfile()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $customerId = $this->session->get('id_customer');

        $userData = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $customerDetailsData = [
            'full_name' => $this->request->getPost('full_name'),
            'phone_number' => $this->request->getPost('phone_number'),
            'address' => $this->request->getPost('address'),
            'membership_level' => $this->request->getPost('membership_level'),
            'total_spent' => $this->request->getPost('total_spent')
        ];

        $updateStatus = $this->CustomerModel->updateUserDetails($customerId, $userData, $customerDetailsData);

        if ($updateStatus) {
            return redirect()->to('/home/profile')->with('success', 'Profile updated successfully!');
        } else {
            return redirect()->to('/home/profile')->with('error', 'Failed to update profile!');
        }
    }
}
