<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\OrderModel;

class Order extends ResourceController
{
    use ResponseTrait;

    /**
     * Retrieve all orders from the database.
     *
     * @return mixed Response with orders data if found, else failure message.
     */
    public function index()
    {
        $model = new OrderModel();
        $orders = $model->findAll();
    
        if ($orders) {
            return $this->respond($orders);
        } else {
            return $this->failNotFound('No orders found.');
        }
    }
    
    /**
     * Create a new order entry.
     *
     * @return mixed Response indicating success or failure of the order creation process.
     */
    public function create()
    {    
        $model = new OrderModel();
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
     * Update an existing order entry by its ID.
     *
     * @param int|null $id The ID of the order entry to update.
     * @return mixed Response indicating success or failure of the update process.
     */
    public function update($id = null)
    {
        $model = new OrderModel();
        $data = $this->request->getJSON(true);
    
        // Validate input data before updating.
        if (empty($data)) {
            return $this->failValidationErrors('No data provided.');
        }

        // Check if the order with the given ID exists
        $order = $model->find($id);
        if (!$order) {
            return $this->failNotFound('Order not found.');
        }

        // Update the order status
        $updated = $model->update($id, $data);

        if ($updated) {
            return $this->respondUpdated($data, 'Order updated successfully.');
        } else {
            return $this->failServerError('Failed to update order.');
        }
    }

}
