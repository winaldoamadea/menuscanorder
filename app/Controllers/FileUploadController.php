<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class FileUploadController extends Controller
{
    /**
     * Constructor method to load necessary helpers.
     */
    public function __construct()
    {
        // Load the URL helper for use in views
        helper('url'); 
    }

    /**
     * Display the file upload form.
     *
     * @return mixed View for the file upload form.
     */
    public function index()
    {
        return view('uploadform');
    }

    /**
     * Handle file upload.
     *
     * @param int $userId The ID of the user associated with the file.
     * @return mixed Response indicating success or failure of the file upload process.
     */
    public function upload($userId)
    {
        // Retrieve uploaded file
        $file = $this->request->getFile('file');

        // Specify the target directory within the public folder based on user ID
        $targetDirectory = FCPATH . 'public/images/' . $userId . '/';
        
        // Check if the file is valid and not moved
        if ($file->isValid() && !$file->hasMoved()) {
            // Get the original filename
            $originalName = $file->getName();
        
            // Move the uploaded file to the desired public directory with its original name
            $file->move($targetDirectory, $originalName);
        
            // Construct the public path to the uploaded file
            $publicPath = base_url('images/' . $userId . '/' . $originalName);
        
            // Store the public path or file information in the database or perform other operations
        
            // Return JSON response indicating success and public path
            return $this->response->setJSON(['success' => true, 'public_path' => $publicPath]);
        } else {
            // Return JSON response indicating failure
            return $this->response->setJSON(['success' => false]);
        }
    }
}
