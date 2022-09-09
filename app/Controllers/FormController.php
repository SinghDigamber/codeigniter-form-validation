<?php 
namespace App\Controllers;
use App\Models\FormModel;
use CodeIgniter\Controller;

class FormController extends Controller
{

    public function index() {
        helper(['form']);
        $data = [];
        return view('contact_form');
    }
 
    public function store() {
        helper(['form']);
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'phone' => 'required|numeric|max_length[10]'
        ];
          
        if($this->validate($rules)){
            $formModel = new FormModel();

            $data = [
                'name' => $this->request->getVar('name'),
                'email'  => $this->request->getVar('email'),
                'phone'  => $this->request->getVar('phone'),
            ];

            $formModel->save($data);

            return redirect()->to('/contact-form');
        }else{
            $data['validation'] = $this->validator;
            echo view('contact_form', $data);
        }        
    }

}
