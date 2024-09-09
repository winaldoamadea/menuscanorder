<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\TableModel;
use App\Models\BusinessModel;

class Tables extends ResourceController
{
    use ResponseTrait;

    /**
     * Create new tables for a business.
     *
     * @return mixed Response indicating success or failure of the table creation process.
     */
    public function create()
    {
        $model = new TableModel();
        $businessModel = new BusinessModel();
        $data = $this->request->getJSON(true);
    
        // Ensure the received data is an array.
        if (empty($data)) {
            return $this->failValidationErrors('No data provided.');
        }   
    
        // Get the business based on the user ID
        $business = $businessModel->where('user_id', $data['user_id'])->first();
        if (!$business) {
            return $this->failValidationError('Invalid user ID.');
        }
    
        // Get all existing table numbers for the business
        $existingTableNumbers = $model->select('number')->where('business_id', $business['business_id'])->findAll();
        $existingTableNumbers = array_column($existingTableNumbers, 'number');
    
        // Find missing table numbers
        $missingTableNumbers = [];
        $numberOfTablesToAdd = $data['number'];
    
        // Start with the first number if no tables exist
        if (empty($existingTableNumbers)) {
            $startNumber = 1;
        } else {
            sort($existingTableNumbers);
            $startNumber = 1;
            foreach ($existingTableNumbers as $number) {
                if ($startNumber < $number) {
                    $missingTableNumbers = array_merge($missingTableNumbers, range($startNumber, $number - 1));
                }
                $startNumber = $number + 1;
            }
        }
    
        // Calculate the end number based on the desired number of tables to create, including missing tables
        $endNumber = $startNumber + $numberOfTablesToAdd - 1;
    
        // If there are missing table numbers, insert them
        $missingCount = $numberOfTablesToAdd - count($missingTableNumbers);
        if ($missingCount > 0) {
            $endNumber += $missingCount; // Increase the end number to accommodate additional tables
            $missingTableNumbers = array_merge($missingTableNumbers, range($startNumber, $endNumber - 1));
        }
    
        // Limit the number of tables to be created to the requested number, including missing tables
        $missingTableNumbers = array_slice($missingTableNumbers, 0, $numberOfTablesToAdd);
    
        // Insert all missing table numbers
        foreach ($missingTableNumbers as $missingTableNumber) {
            $model->insert([
                'business_id' => $business['business_id'],
                'number' => $missingTableNumber
            ]);
        }
    
        // Respond with success message
        return $this->respondCreated($missingTableNumbers, 'Tables created successfully.');
    }
    
    /**
     * Show a specific table entry by its ID.
     *
     * @param int|null $id The ID of the table entry to retrieve.
     * @return mixed Response containing the table data if found, else failure message.
     */
    public function show($id = null)
    {
        $model = new TableModel();

        // Attempt to retrieve the specific table entry by ID.
        $data = $model->find($id);

        // Check if data was found.
        if ($data) {
            return $this->respond($data);
        } else {
            // Return a 404 error if no data is found.
            return $this->failNotFound("No table entry found with ID: {$id}");
        }
    }
    
    /**
     * Delete a table entry by its ID.
     *
     * @param int|null $id The ID of the table entry to delete.
     * @return mixed Response indicating success or failure of the deletion process.
     */
    public function delete($id = null)
    {
        $model = new TableModel();

        // Check if the record exists before attempting deletion.
        if (!$model->find($id)) {
            return $this->failNotFound("No table entry found with ID: {$id}");
        }

        // Attempt to delete the record.
        if ($model->delete($id)) {
            return $this->respondDeleted(['id' => $id, 'message' => 'Table data deleted successfully.']);
        } else {
            return $this->failServerError('Failed to delete table data.');
        }
    }
}
