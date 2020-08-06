<?php 
namespace App\Controllers;
use App\Models\FormModel;
use CodeIgniter\Controller;

class FormController extends Controller
{

    public function create() {
        return view('contact_form');
    }
 
    public function form() {
        helper(['form', 'url']);
        
        $input = $this->validate([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'phone' => 'required|numeric|max_length[10]'
        ]);

        $formModel = new FormModel();
 
        if (!$input) {
            echo view('contact_form', [
                'validation' => $this->validator
            ]);
        } else {
            $formModel->save([
                'name' => $this->request->getVar('name'),
                'email'  => $this->request->getVar('email'),
                'phone'  => $this->request->getVar('phone'),
            ]);          

            return $this->response->redirect(site_url('/submit-form'));
        }
    }

}