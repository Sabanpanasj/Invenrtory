<?php
defined('BASEPATH') or exit('No direct script access allowed');
require'vendor/autoload.php';
class InventoryController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AddnewModel');
        $this->load->model('ProductModel');
        $this->load->library(['session', 'form_validation']);
        $this->check_login(); 
    }

    private function check_login()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    
    public function addnew()
    {
        $data['inventory'] = $this->AddnewModel->getinventory();
        $this->load->view('pages/addnew', $data);
    }

    
    public function savedata()
    {
        $this->form_validation->set_rules('products', 'Product Name', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('DateProduce', 'Date of Production', 'required');
        $this->form_validation->set_rules('expirationDate', 'Expiration Date', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->addnew();
            return; // Stop further execution if validation fails
        }
    
        // Validate the image input
        if (empty($_FILES['Photo']['name'])) {
            $this->session->set_flashdata('type', 'error');
            $this->session->set_flashdata('message', 'Product Image is required.');
            redirect('addnew');
            return; // Stop further execution if image is missing
        }
    
        $photoPath = ''; // Initialize variable for photo path
    
        if (!empty($_FILES['Photo']['name'])) {
            $config['upload_path'] = './assets/Upload/Images/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB
            $config['file_name'] = time() . '_' . $_FILES['Photo']['name']; // Unique filename
    
            $this->load->library('upload', $config); // Load upload library
    
            if ($this->upload->do_upload('Photo')) {
                $uploadData = $this->upload->data();
                $photoPath = 'assets/Upload/Images/' . $uploadData['file_name']; // Set correct path
            } else {
                // File upload failed
                $this->session->set_flashdata('type', 'error');
                $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect('addnew');
                return; // Stop further execution on upload failure
            }
        }
    
        $data = [
            'products' => $this->input->post('products', TRUE),
            'Photo' => $photoPath, // Save photo path in the database
            'quantity' => $this->input->post('quantity', TRUE),
            'price' => $this->input->post('price', TRUE),
            'DateProduce' => $this->input->post('DateProduce', TRUE),
            'expirationDate' => $this->input->post('expirationDate', TRUE),
        ];
    
        $response = $this->ProductModel->saverecords($data);
    
        if ($response) {
            $this->session->set_flashdata('message', 'Product added successfully!');
            $this->session->set_flashdata('type', 'success');
        } else {
            $this->session->set_flashdata('message', 'An error occurred while adding the product.');
            $this->session->set_flashdata('type', 'error');
        }
    
        redirect('addnew', 'refresh');
    }
    
    
    public function update()
{
    // Set validation rules
    $this->form_validation->set_rules('products', 'Product Name', 'required');
    $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');
    $this->form_validation->set_rules('price', 'Price', 'required|numeric');
    $this->form_validation->set_rules('DateProduce', 'Date of Production', 'required');
    $this->form_validation->set_rules('expirationDate', 'Expiration Date', 'required');

    if ($this->form_validation->run() == FALSE) {
        // Validation failed, reload the form with error messages
        $this->session->set_flashdata('type', 'error');
        $this->session->set_flashdata('message', validation_errors());
        redirect('addnew');
    } else {
        // Get input values
        $productId = $this->input->post('product_id');
        $productName = $this->input->post('products');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $dateProduce = $this->input->post('DateProduce');
        $expirationDate = $this->input->post('expirationDate');
        $photo = $_FILES['Photo'];

        // Retrieve the existing photo from the form (or fallback to an empty string if not provided)
        $currentPhoto = $this->input->post('currentPhoto');
        
        // Set photoPath to the existing photo if no new photo is uploaded
        $photoPath = !empty($currentPhoto) ? $currentPhoto : null; // Keep existing photo if no new photo is uploaded

        // Handle new photo upload if a file is selected
        if (!empty($photo['name'])) {
            // Set upload configuration
            $config['upload_path'] = './assets/Upload/Images/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // Max size in KB (2MB)
            $config['file_name'] = time() . '_' . $photo['name']; // Unique filename

            $this->load->library('upload', $config);

            // Perform the file upload
            if ($this->upload->do_upload('Photo')) {
                $uploadData = $this->upload->data();
                $photoPath = 'assets/Upload/Images/' . $uploadData['file_name']; // Set the new uploaded photo path
            } else {
                // If upload fails, show an error and retain the current photo
                $this->session->set_flashdata('type', 'error');
                $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect('addnew');
                return;
            }
        }

        // Prepare data for updating the product
        $updateData = [
            'products' => $productName,
            'quantity' => $quantity,
            'price' => $price,
            'DateProduce' => $dateProduce,
            'expirationDate' => $expirationDate,
        ];

        // Only update the photo if a new one is uploaded
        if ($photoPath !== null) {
            $updateData['Photo'] = $photoPath;
        }

        // Perform the update operation
        $response = $this->ProductModel->updateData($productId, $updateData);

        if ($response) {
            $this->session->set_flashdata('type', 'success');
            $this->session->set_flashdata('message', 'Product updated successfully!');
            redirect('addnew');
        } else {
            $this->session->set_flashdata('type', 'error');
            $this->session->set_flashdata('message', 'Failed to update product.');
            redirect('addnew');
        }
    }
}


    

    


    
   
    public function delete($id)
    {
        if ($this->ProductModel->delete_item($id)) {
            $this->session->set_flashdata('type', 'success');
            $this->session->set_flashdata('message', 'Product deleted successfully!');
        } else {
            $this->session->set_flashdata('type', 'error');
            $this->session->set_flashdata('message', 'Failed to delete product.');
        }

        redirect('InventoryController/addnew', 'refresh');
    }
}
