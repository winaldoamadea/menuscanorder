<?php

namespace App\Models; // Namespace declaration for organizing classes.

use CodeIgniter\Model; // Importing the base Model class from CodeIgniter.

/**
 * OrderItemModel represents a model for interacting with the 'order_item' table in the database.
 * 
 * This model extends CodeIgniter's Model class, providing methods for CRUD operations
 * and other database interactions related to the 'order_item' table.
 */
class OrderItemModel extends Model
{
    protected $table = 'order_item'; // Specifies the database table this model should interact with.

    protected $primaryKey = 'id'; // Defines the primary key field of the table for CRUD operations.

    /**
     * The fields that are allowed to be mass-assigned.
     * This helps in preventing mass assignment vulnerabilities.
     */
    protected $allowedFields = ['order_id', 'product_id', 'quantity'];

    protected $returnType = 'array'; // Sets the default return type of the results. This model returns results as arrays.
}
