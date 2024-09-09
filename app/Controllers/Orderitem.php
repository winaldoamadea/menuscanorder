<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MenuModel;
use App\Models\TableModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;

class OrderItem extends ResourceController
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
     * Create order items based on received data.
     *
     * @return mixed Response indicating success or failure of the order item creation process.
     */
    public function create()
    {
        $data = $this->request->getJSON(true);

        // Extract the table number from the received data
        $tableNumber = $data['tableNumber'];

        $tableModel = new TableModel();
        $table = $tableModel->where('id', $tableNumber)->first();

        $orderModel = new OrderModel();
        $order = $orderModel->where('table_id', $table['id'])
                           ->where('status', 'Not Complete')
                           ->first();

        $orderItemModel = new OrderItemModel();

        if ($order){
            $orderId = $order['id'];
        }
        else{
            $newOrderData = [
                'business_id' => $table['business_id'], // Assuming the business ID is associated with the table
                'table_id' => $table['id'],
                'status' => 'Not Complete'
                // Add any other fields you may need for the order
            ];
            $newOrderId = $orderModel->insert($newOrderData);
            $orderId = $orderModel->insertID();
        }


        // Insert each item into the order_item table
        foreach ($data['items'] as $item) {
            $orderItemData = [
                'order_id' => $orderId, // You need to insert the order_id here. You may need to fetch it based on the table_id and status from the orders table.
                'product_id' => $item['id'], // Assuming the 'id' corresponds to the 'product_id' in the order_item table.
                'quantity' => $item['quantity']
            ];

            // Save the order item data to the database
            $orderItemModel->insert($orderItemData); // Assuming you have a model for the order_item table named $orderItemModel
        }
    
        // Return a success response
        return $this->respondCreated(['message' => 'Order items created successfully']);
    }
}
