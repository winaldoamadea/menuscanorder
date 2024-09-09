<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class User extends ResourceController
{
    use ResponseTrait;

    /**
     * Retrieve all users from the database.
     *
     * @return mixed Response with users data if found, else failure message.
     */
    public function index()
    {
        $model = new UserModel();
        $users = $model->findAll();
    
        if ($users) {
            return $this->respond($users);
        } else {
            return $this->failNotFound('No users found.');
        }
    }

    /**
     * Not implemented for user creation.
     *
     * @return mixed Failure message indicating the method is not implemented.
     */
    public function create()
    {    
        $model = new UserModel();
        $data = $this->request->getJSON(true);
    
        // Validate input data before insertion.
        if (empty($data)) {
            return $this->failValidationErrors('No data provided.');
        }
    
        // Insert data and check for success.
        $inserted = $model->insert($data);
        if ($inserted) {
            return $this->respondCreated($data, 'Order created successfully.');
        } else {
            return $this->failServerError('Failed to create order.');
        }
    }

    /**
     * Update a user by ID.
     *
     * @param int|null $id User ID to be updated.
     * @return mixed Response indicating success or failure of the update process.
     */
    public function update($id = null)
    {
        $model = new UserModel();
        $data = $this->request->getJSON(true);
    
        if (empty($data)) {
            return $this->failValidationErrors('No data provided.');
        }
    
        $user = $model->find($id);
        
        if (!$user) {
            return $this->failNotFound('User not found.');
        }
    
        $updated = $model->update($id, $data);
    
        if ($updated) {
            return $this->respondUpdated($data, 'User updated successfully.');
        } else {
            return $this->failServerError('Failed to update user.');
        }
    }
}
