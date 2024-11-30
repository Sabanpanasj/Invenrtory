<?php
defined('BASEPATH') or exit('No direct script access allowed');
require'vendor/autoload.php';
class ExcelController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session']);
        $this->check_login(); 
    }
    private function check_login()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }
    public function uploadExcelView()
    {
        $this->load->view('pages/excelview');
    }

    public function uploadExcel()
    {
        if (empty($_FILES['ExcelImport']['tmp_name'])) {
            $this->session->set_flashdata('status', 'No file selected.');
            redirect(base_url('Excel'));
        }

        try {
            $fileTmpName = $_FILES['ExcelImport']['tmp_name'];
            $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($fileTmpName);
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
            $spreadsheet = $reader->load($fileTmpName);
            $sheet = $spreadsheet->getActiveSheet();

            $data = [];
            foreach ($sheet->getRowIterator() as $row) {
                if ($row->getRowIndex() == 1) continue;

                $data[] = [
                    'id'             => $sheet->getCell('A' . $row->getRowIndex())->getValue(),
                    'products'       => $sheet->getCell('B' . $row->getRowIndex())->getValue(),
                    'quantity'       => $sheet->getCell('C' . $row->getRowIndex())->getValue(),
                    'price'          => $sheet->getCell('D' . $row->getRowIndex())->getValue(),
                    'Dateproduce'    => $sheet->getCell('E' . $row->getRowIndex())->getValue(),
                    'expirationDate' => $sheet->getCell('F' . $row->getRowIndex())->getValue(),
                ];
            }

            if (!empty($data)) {
                $this->load->model('ExcelModel');
                $this->ExcelModel->batchInsert($data);
                $this->session->set_flashdata('status', 'Data imported successfully.');
            } else {
                $this->session->set_flashdata('status', 'No valid data found in the file.');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            $this->session->set_flashdata('status', 'Error reading file: ' . $e->getMessage());
        }

        redirect(base_url('Excel'));
    }
}
