<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class MenuController extends BaseController
{
    /**
     * Constructor method to load necessary helpers.
     */
    public function __construct()
    {
        // Load the URL helper for use in views
        helper('url'); 
    }

    /**
     * Display the homepage.
     *
     * @return mixed View for the homepage.
     */
    public function index()
    {
        return view('homepage');
    }

    /**
     * Display the projects page.
     *
     * @return mixed View for the projects page.
     */
    public function projects()
    {
        return view('projects');
    }

    /**
     * Display the login page.
     *
     * @return mixed View for the login page.
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Display the registration page.
     *
     * @return mixed View for the registration page.
     */
    public function register()
    {
        return view('register');
    }

    /**
     * Redirect to the homepage.
     *
     * @return mixed View for the homepage.
     */
    public function homepage()
    {
        return view('homepage');
    }

    /**
     * Display the admin panel with user data.
     *
     * @return mixed View for the admin panel.
     */
    public function admin()
    {
        // Create an instance of the UserModel
        $model = new \App\Models\UserModel();
    
        // Fetch data from the database using the UserModel
        $data['users'] = $model->findAll();
    
        return view('admin', $data);
    }

    /**
     * Display the menu with registered items.
     *
     * @param int $id The ID of the user.
     * @return mixed View for the menu.
     */
    public function menuregister($id)
    {

        $loggedInUserId = session()->get('id');
        
        // Check if the logged-in user ID matches the provided ID
        if ($id != $loggedInUserId) {
            return "Unauthorized access"; // You can customize this message or redirect the user to a different page
        }
        // Load necessary models
        $userModel = new \App\Models\UserModel();
        $businessModel = new \App\Models\BusinessModel();
        $menuModel = new \App\Models\MenuModel();
        $productModel = new \App\Models\ProductModel();
        $categoryModel = new \App\Models\CategoryModel(); // Load the CategoryModel
        
        // Retrieve user data
        $user = $userModel->find($id);
        
        if ($user === null) {
            return "User not found";
        }

        // Retrieve business data
        $business = $businessModel->where('user_id', $id)->first();
        
        if ($business === null) {
            return redirect()->to('/register-business/' . session()->get('id'));
        }

        // Retrieve menu data
        $menu = $menuModel->where('business_id', $business['business_id'])->first();
        
        if ($menu === null) {
            return redirect()->to('/register-menu-name/' . session()->get('id'));
        }

    
        // Retrieve products associated with the menu
        $products = $productModel->where('menu_id', $menu['id'])->paginate();
        $tes = $productModel->where('menu_id', $menu['id'])->findAll();
        $data['pager'] = $productModel->pager;
        if ($products) {
            foreach ($products as &$product) {
                // Convert image BLOB to base64
                $product['imageData'] = base64_encode($product['image']);
                $product['imageType'] = substr($product['imageData'], 11, strpos($product['imageData'], ';') - 11); // Extracts the image type (e.g., "png" or "jpeg")
                
                // Retrieve category data for the product
                $category = $categoryModel->find($product['category_id']);
                if ($category) {
                    $product['category_name'] = $category['name'];
                } else {
                    $product['category_name'] = 'Category not found'; 
                }
            }

            $data['products'] = $products;
        }

        // Prepare data to pass to the view
        $data['user'] = $user;
        $data['business'] = $business;
        $data['menu'] = $menu;
        
        // Load the menu view with the data
        return view('menu', $data);
    }

    /**
     * Display the tables with active orders.
     *
     * @param int $id The ID of the user.
     * @return mixed View for the tables.
     */
    public function tables($id)
    {
        $loggedInUserId = session()->get('id');
        
        // Check if the logged-in user ID matches the provided ID
        if ($id != $loggedInUserId) {
            return "Unauthorized access"; // You can customize this message or redirect the user to a different page
        }
        // Load necessary models
        $tableModel = new \App\Models\TableModel();
        $menuModel = new \App\Models\MenuModel();
        $productModel = new \App\Models\ProductModel();
        $categoryModel = new \App\Models\CategoryModel();
        $orderModel = new \App\Models\OrderModel();
        $orderItemModel = new \App\Models\OrderItemModel();
        $businessModel = new \App\Models\BusinessModel();
        $userModel = new \App\Models\UserModel();
    
        // Retrieve user data
        $user = $userModel->find($id);
        
        if ($user === null) {
            return "User not found";
        }

        // Retrieve business data
        $business = $businessModel->where('user_id', $id)->first();
        
        if ($business === null) {
            return redirect()->to('/register-business/' . session()->get('id'));
        }

        // Retrieve tables associated with the business
        $tables = $tableModel->where('business_id', $business['business_id'])->findAll();
    
        foreach ($tables as &$table) {
            // Retrieve active order for the table
            $order = $orderModel->where('table_id', $table['id'])
                                ->where('status !=', 'Complete')
                                ->first();
            if ($order) {
                // If an active order is found for the table, update the table data with the order ID
                $table['order'] = $order;
                // Fetch all order items for this order
                $orderItems = $orderItemModel->where('order_id', $order['id'])->findAll();
                // Fetch the product details for each order item
                foreach ($orderItems as &$orderItem) {
                    $product = $productModel->find($orderItem['product_id']);
                    // Add product details to the order item
                    if ($product) {
                        $orderItem['product_name'] = $product['name'];
                        $orderItem['product_price'] = $product['price'];
                    }
                }
                // Assign the updated order items to the table
                $table['orderItems'] = $orderItems;
            } else {
                // If no active order is found for the table, set the order ID to null
                $table['order'] = null;
                // Set order items to an empty array
                $table['orderItems'] = [];
            }
        }
    
        $data['user'] = $user;
        $data['tables'] = $tables;
        $data['business'] = $business;

        return view('tables', $data);
    }

    /**
     * Display the menu for a specific table.
     *
     * @param int $id The ID of the table.
     * @return mixed View for the customer menu.
     */
    public function menus($id)
    {
        // Load necessary models
        $tableModel = new \App\Models\TableModel();
        $menuModel = new \App\Models\MenuModel();
        $productModel = new \App\Models\ProductModel();
        $categoryModel = new \App\Models\CategoryModel();

        // Retrieve table data
        $table = $tableModel->where('id',$id)->first();
        $businessId = $table['business_id'];

        // Retrieve menu data associated with the table
        $menu = $menuModel->where('business_id', $businessId )->first();
        $menuId = $menu['id'];

        // Retrieve products associated with the menu
        $products = $productModel->where('menu_id', $menuId)->findAll();

        // Retrieve categories associated with the menu
        $categories = $categoryModel->where('menu_id',$menuId)->findAll();


        if ($products) {
            foreach ($products as &$product) {
                // Convert image BLOB to base64
                $product['imageData'] = base64_encode($product['image']);
                $product['imageType'] = substr($product['imageData'], 11, strpos($product['imageData'], ';') - 11); // Extracts the image type (e.g., "png" or "jpeg")
            }

            $data['products'] = $products;
        }
        
        $data['categories'] = $categories;
        $data['table'] = $table;
        
        return view('customer-menu',$data);
    }

    /**
     * Display the business registration form.
     *
     * @param int $id The ID of the user.
     * @return mixed View for the business registration form.
     */
    public function register_business($id)
    {
        // Load necessary models
        $userModel = new \App\Models\UserModel();
        $loggedInUserId = session()->get('id');
        
        // Check if the logged-in user ID matches the provided ID
        if ($id != $loggedInUserId) {
            return "Unauthorized access"; // You can customize this message or redirect the user to a different page
        }
        
        // Retrieve user data
        $user = $userModel->find($id);
        $data['user'] = $user;

        return view('register-business',$data);
    }

    /**
     * Display the menu registration form.
     *
     * @param int $id The ID of the user.
     * @return mixed View for the menu registration form.
     */
    public function register_menu($id)
    {
        // Load necessary models
        $userModel = new \App\Models\UserModel();
        $businessModel = new \App\Models\BusinessModel();
        $loggedInUserId = session()->get('id');
        
        // Check if the logged-in user ID matches the provided ID
        if ($id != $loggedInUserId) {
            return "Unauthorized access"; // You can customize this message or redirect the user to a different page
        }

        // Retrieve user and business data
        $user = $userModel->find($id);
        $business = $businessModel->where('user_id', $id)->first();
        
        // Prepare data to pass to the view
        $data['user'] = $user;
        $data['business'] = $business;

        return view('register-menu',$data);
    }

    /**
     * Generate a QR code for a specific table.
     *
     * @param int $tableId The ID of the table.
     * @return string Base64-encoded image data of the QR code.
     */
    public function generateQRCode($tableId)
    {
        // Construct the URL based on the table number
        $url = 'https://infs3202-1307026f.uqcloud.net/menuscanorder/order/' . $tableId; // Adjust the URL pattern as needed
    
        // Generate the QR code with the constructed URL
        $qr_code = QrCode::create($url);
        $writer = new PngWriter;
        $result = $writer->write($qr_code);
    
        // Get the QR code image data
        $qr_code_data = $result->getString();
    
        // Encode the image data as base64
        $qr_code_base64 = base64_encode($qr_code_data);
    
        // Return the base64-encoded image data
        return $qr_code_base64;
    }
}
