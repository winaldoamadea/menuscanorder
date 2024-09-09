<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * BusinessModel represents a model for interacting with the 'Business' table in the database.
 * 
 * This model extends CodeIgniter's Model class, providing methods for CRUD operations
 * and other database interactions related to the 'Business' table.
 */
class BusinessModel extends Model
{
    // Define the table name
    protected $table = 'Business';

    // Define the primary key field name
    protected $primaryKey = 'business_id';

    // Define the fields that are allowed to be mass-assigned
    protected $allowedFields = ['user_id', 'name', 'table'];

    // Specify the return type of query results
    protected $returnType = 'array';
}