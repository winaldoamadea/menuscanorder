<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MenuModel;

class Menu extends ResourceController
{
    use ResponseTrait;

    /**
     * Retrieve all products from the database.
     *
     * @return mixed Response with products data if found, else failure message.
     */
    public function index()
    {
        $model = new MenuModel();
        $products = $model->findAll();
    
        if ($products) {
            return $this->respond($products);
        } else {
            return $this->failNotFound('No products found.');
        }
    }

    /**
     * Create a new menu item.
     *
     * @return mixed Response indicating success or failure of the menu item creation process.
     */
    public function create()
    {    
        $model = new MenuModel();
        $data = $this->request->getJSON(true);
    
        // Validate input data before insertion.
        if (empty($data)) {
            return $this->failValidationErrors('No data provided.');
        }
    
        // Insert data and check for success.
        $inserted = $model->insert($data);
        if ($inserted) {
            return $this->respondCreated($data, 'Menu item created successfully.');
        } else {
            return $this->failServerError('Failed to create menu item.');
        }

    }



}
