<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;
use CodeIgniter\Config\Services;
use App\Models\BusinessModel;
use App\Models\MenuModel;

class Items extends ResourceController
{
    use ResponseTrait;

    /**
     * Retrieve items associated with the logged-in user's business from the database.
     *
     * @return mixed Response with items data if found, else failure message.
     */
    public function index()
    {
        $session = Services::session();
        $model = new ProductModel();

        $sessionId = $session->get('id');

        $businessModel = new BusinessModel();
        
        // Find the business associated with the user ID
        $business = $businessModel->where('user_id', $sessionId)->first();
        if ($business) {
            // Business found, now find the menu associated with the business
            $menuModel = new MenuModel();
            $menu = $menuModel->where('business_id', $business['business_id'])->first();
            
            if ($menu) {
                // Menu found, now find all items in the menu
                $items = $model->where('menu_id', $menu['id'])->findAll();
                
                // Check if items were found
                if ($items) {
                    return $this->respond($items);
                } else {
                    return $this->failNotFound('No items found in the menu.');
                }
            } else {
                return $this->failNotFound('Menu not found.');
            }
        } else {
            return $this->failNotFound('Business not found.');
        }
    }

    /**
     * Create a new item.
     *
     * @return mixed Response indicating success or failure of the item creation process.
     */
    public function create()
    {    
        // Save product details to the database
        $productModel = new ProductModel();
        
        // Retrieve JSON data from the request
        $requestData = $this->request->getJSON(true); 
    
        // Hardcode the image name for testing
        $imageName = $requestData['itemImageName'];
    
        // Specify the target directory within the public folder
        $userId = $requestData['user_id']; // Assuming 'userId' is the key for user ID
        $targetDirectory = FCPATH . 'public/images/' . $userId . '/';
    
        // Construct the full path to the image file
        $imagePath = $targetDirectory . $imageName;
        
        // Check if the image file exists
        if (file_exists($imagePath)) {
            $imageData = file_get_contents($imagePath);
            // Prepare the data array
            $data = [
                'name' => $requestData['itemName'], 
                'menu_id' => $requestData['menu_id'], // Assuming 'menu_id' is the key for menu ID
                'category_id' => $requestData['itemCategories'], // Assuming 'itemCategories' is the key for category ID
                'description' => $requestData['itemDescription'], // Assuming 'itemDescription' is the key for item description
                'price' => $requestData['itemPrice'], // Assuming 'itemPrice' is the key for item price
                'image' => $imageData, // Store the relative path to the image in the database
            ];
    
            // Insert the data into the database
            $success = $productModel->insert($data);
            
            if ($success) {
                return $this->respondCreated($data, 'Item created successfully.');
            } else {
                return $this->failServerError('Failed to create item.');
            }
        } else {
            // Handle the case where the image file does not exist
            return $this->failServerError('Image file does not exist.');
        }
    }

    /**
     * Update an existing item by its ID.
     *
     * @param int|null $id The ID of the item to update.
     * @return mixed Response indicating success or failure of the update process.
     */
    public function update($id = null)
    {
        $model = new ProductModel();
        $requestData = $this->request->getJSON(true);
    
        // Validate input data before updating.
        if (empty($requestData)) {
            return $this->failValidationErrors('No data provided.');
        }

        $data = [
            'name' => $requestData['itemName'], // Assuming 'itemName' is the key for item name
            'category_id' => $requestData['itemCategories'], // Assuming 'itemCategories' is the key for category ID
            'description' => $requestData['itemDescription'], // Assuming 'itemDescription' is the key for item description
            'price' => $requestData['itemPrice'], // Assuming 'itemPrice' is the key for item price 
        ];

        // Check if the item with the given ID exists
        $item = $model->find($id);
        if (!$item) {
            return $this->failNotFound('Item not found.');
        }
        // Update the item details
        $updated = $model->update($id, $data);

        if ($updated) {
            return $this->respondUpdated($data, 'Item updated successfully.');
        } else {
            return $this->failServerError('Failed to update item.');
        }
    }

    /**
     * Delete an existing item by its ID.
     *
     * @param int|null $id The ID of the item to delete.
     * @return mixed Response indicating success or failure of the deletion process.
     */
    public function delete($id = null)
    {
        $model = new ProductModel();

        // Check if the record exists before attempting deletion.
        if (!$model->find($id)) {
            return $this->failNotFound("No item found with ID: {$id}");
        }

        // Attempt to delete the record.
        if ($model->delete($id)) {
            return $this->respondDeleted(['id' => $id, 'message' => 'Item deleted successfully.']);
        } else {
            return $this->failServerError('Failed to delete item.');
        }
    }

}
