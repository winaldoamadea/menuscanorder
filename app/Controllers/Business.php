<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\BusinessModel;
use App\Models\TableModel;

class Business extends ResourceController
{
    use ResponseTrait;

    /**
     * Retrieve all businesses.
     *
     * @return mixed JSON response containing all businesses.
     */
    public function index()
    {
        $model = new BusinessModel();
        $businesses = $model->findAll(); // Retrieve all businesses from the database
    
        // Check if businesses were found
        if ($businesses) {
            return $this->respond($businesses);
        } else {
            return $this->failNotFound('No businesses found.');
        }
    }

    /**
     * Create a new business and associated tables.
     *
     * @return mixed JSON response indicating success or failure.
     */
    public function create()
    {    
        $businessModel = new BusinessModel();
        $tableModel = new TableModel();
        $data = $this->request->getJSON(true);  // Ensure the received data is an array.
    
        // Validate input data before insertion.
        if (empty($data)) {
            return $this->failValidationErrors('No data provided.');
        }
    
        // Insert business data and check for success.
        $insertedBusiness = $businessModel->insert($data);
        if ($insertedBusiness) {
            $numTables = $data['table']; // Assuming 'table' is the key for specifying the number of tables
            for ($i = 1; $i <= $numTables; $i++) {
                $tableData = [
                    'business_id' => $insertedBusiness,
                    'number' => $i,
                    // Add other table attributes as needed
                ];
                $insertedTable = $tableModel->insert($tableData);
                if (!$insertedTable) {
                    // Rollback business insertion if table insertion fails
                    $businessModel->delete($insertedBusiness);
                    return $this->failServerError('Failed to create tables.');
                }
            }
            
            return $this->respondCreated($data, 'Business and associated tables created successfully.');
        } else {
            return $this->failServerError('Failed to create business.');
        }
    }
}
