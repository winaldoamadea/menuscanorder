<?php

namespace App\Models; // Namespace declaration for organizing classes.

use CodeIgniter\Model; // Importing the base Model class from CodeIgniter.

/**
 * MenuModel represents a model for interacting with the 'menu' table in the database.
 * 
 * This model extends CodeIgniter's Model class, providing methods for CRUD operations
 * and other database interactions related to the 'menu' table.
 */
class MenuModel extends Model
{
    protected $table = 'menu'; // Specifies the database table this model should interact with.

    protected $primaryKey = 'id'; // Defines the primary key field of the table for CRUD operations.

    /**
     * The fields that are allowed to be mass-assigned.
     * This helps in preventing mass assignment vulnerabilities.
     */
    protected $allowedFields = ['business_id', 'title'];

    protected $returnType = 'array'; // Sets the default return type of the results. This model returns results as arrays.
}
