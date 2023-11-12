<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\BankAccountModel;

class BankAccountController extends Controller
{
    private $bankAccount = '' ;
    public function __construct(){
        $this->bankAccount = new BankAccountModel();
    }

    // show bank account list
    public function index()
    {
        $session = session();
        $data['bankAccounts'] = $this->bankAccount->where('deleted_at', NULL)->orderBy('id', 'DESC')->findAll();
        return view('BankAccounts',$data);
    }

    // insert data into database after validation
    public function store(){
        $validation =  \Config\Services::validation();
        // set validation rules
        $validation->setRules([
            'bank_name' => 'required|min_length[3]|max_length[250]|alpha_numeric_space',
            'branch' => 'required|min_length[3]|max_length[250]|alpha_numeric_space',
            'account_number' => 'required|numeric',
        ]);
        // check validation
        if(!$validation->withRequest($this->request)->run()){
            $errors = $validation->getErrors();
            session()->setFlashdata('error', $errors);
            return $this->response->redirect(site_url('/bank_accounts'));
        }else{
            // insert data into database
            $data = [
                'bank_name' => esc($this->request->getVar('bank_name')),
                'branch'  => esc($this->request->getVar('branch')),
                'account_number'  => esc($this->request->getVar('account_number')),
            ];
            $insert = $this->bankAccount->insert($data);
            session()->setFlashdata('success', 'Record added successfully.');
            return $this->response->redirect(site_url('/bank_accounts'));
        }
    }

    // show bank account by id
    public function edit(){
        $id = esc($this->request->getVar('id'));
        if (!isset($id) || empty($id)) {
            echo json_encode(['error' => 'Invalid bank account id.']);
            return;
        }
        $data['bankAccount'] = $this->bankAccount->where('id', $id)->first();
        echo json_encode($data['bankAccount']);
    }

    // update bank account data into database after validation
    public function update(){
        $id = esc($this->request->getVar('id'));
        if (!isset($id) || empty($id)) {
            echo json_encode(['error' => 'Invalid bank account id.']);
            return;
        }
        $validation =  \Config\Services::validation();
        // set validation rules
        $validation->setRules([
            'bank_name' => 'required|min_length[3]|max_length[250]|alpha_numeric_space',
            'branch' => 'required|min_length[3]|max_length[250]|alpha_numeric_space',
            'account_number' => 'required|numeric',
        ]);
        // check validation
        if(!$validation->withRequest($this->request)->run()){
            $errors = $validation->getErrors();
            session()->setFlashdata('error', $errors);
            return $this->response->redirect(site_url('/bank_accounts'));
        }else{
            // update data
            $data = [
                'bank_name' => esc($this->request->getVar('bank_name')),
                'branch'  => esc($this->request->getVar('branch')),
                'account_number'  => esc($this->request->getVar('account_number')),
            ];
            $update = $this->bankAccount->update($id,$data);
            session()->setFlashdata('success', 'Record updated successfully.');
            return $this->response->redirect(site_url('/bank_accounts'));
        }
    }

    // soft delete bank account
    public function delete(){
        $id = esc($this->request->getVar('delete_id'));
        $this->bankAccount->delete($id);
        return $this->response->redirect(site_url('/bank_accounts'));
    }

}

