<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * CategoryModel represents a model for interacting with the 'category' table in the database.
 * 
 * This model extends CodeIgniter's Model class, providing methods for CRUD operations
 * and other database interactions related to the 'category' table.
 */
class CategoryModel extends Model
{
    // Define the table name
    protected $table = 'category';

    // Define the primary key field name
    protected $primaryKey = 'id';

    // Define the fields that are allowed to be mass-assigned
    protected $allowedFields = ['menu_id', 'name'];

    // Specify the return type of query results
    protected $returnType = 'array';

    // You can add any additional methods or custom queries specific to your Category model here
}
