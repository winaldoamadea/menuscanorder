<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CategoryModel;

class Category extends ResourceController
{
    use ResponseTrait;

    /**
     * Create a new category.
     *
     * @return mixed JSON response indicating success or failure.
     */
    public function create()
    {
        $model = new CategoryModel();
        $data = $this->request->getJSON(true);
        
        // Validate input data before insertion.
        if (empty($data)) {
            return $this->failValidationErrors('No data provided.');
        }
        
        // Insert data and check for success.
        $inserted = $model->insert($data);
        if ($inserted) {
            return $this->respondCreated($data, 'Category created successfully.');
        } else {
            return $this->failServerError('Failed to create category.');
        }
    }

    /**
     * Retrieve a specific category by ID.
     *
     * @param int $id The ID of the category.
     * @return mixed JSON response containing the category data.
     */
    public function show($id = null)
    {

        $model = new CategoryModel();

        // Attempt to retrieve the specific category by ID.
        $data = $model->where('menu_id',$id)->findAll();

        // Check if data was found.
        if ($data) {
            return $this->respond($data);
        } else {
            // Return a 404 error if no data is found.
            return $this->failNotFound("No category found with ID: {$id}");
        }
    }
    
    /**
     * Retrieve all categories.
     *
     * @return mixed JSON response containing all categories.
     */
    public function index()
    {
        $model = new CategoryModel();
        $categories = $model->findAll(); // Retrieve all categories from the database

        // Check if categories were found
        if ($categories) {
            return $this->respond($categories);
        } else {
            return $this->failNotFound('No categories found.');
        }
    }
}
