<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmployeeController extends CI_Controller
{

    public function dd()
    {
        foreach (func_get_args() as $x) {
            var_dump($x);
        }
        die;
    }
    public function index()
    {

        $this->load->view('template/header');

        $this->load->model("EmployeeModel");
        $data['employee'] = $this->EmployeeModel->getEmployee();
        $this->load->view('frontend/employee', $data);
        $this->load->view('template/footer');
    }

    public function create()
    {

        $this->load->view('template/header');
        $this->load->view('frontend/create');
        $this->load->view('template/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('salary', 'salary', 'required');

        // $this->form_validation->set_rules('prod_image', 'image', 'required');


        if ($this->form_validation->run()) {

            $ori_filename = $_FILES['image']['name'];
            $new_name  = time() . "" . str_replace(' ', '-', $ori_filename);
            $config = [
                'upload_path' => './asset/img/',
                'allowed_types' => 'gif|jpg|png',
                'file_name'   => $new_name,
            ];
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $imageError = array('imageError' => $this->upload->display_errors());
                $this->load->view('template/header');
                $this->load->view('frontend/create', $imageError);
                $this->load->view('template/footer');
            } else {
                $prod_filename = $this->upload->data('file_name');
                $data = [
                    'first_name' => $this->input->post('first_name'),
                    'last_name'  => $this->input->post('last_name'),
                    'phone'      => $this->input->post('phone'),
                    'email'      => $this->input->post('email'),
                    'salary'      => $this->input->post('salary'),
                    'img'        => $prod_filename
                ];
                $this->load->model('EmployeeModel', 'emp');
                $this->emp->insertEmployee($data);
                redirect(base_url('employee'));
            }
        } else {
            $this->create();
            // or
            // redirect(base_url('employee/add'));
        }
    }

    public function storeOperation(){
        
            $data = [
                'operation_name' => $this->input->post('operation_name'),
                'amount'         => $this->input->post('amount'),
                'operation_type' => $this->input->post('operation_type'),
                'operation'      => $this->input->post('operation'),
                'emp_id'         => $this->input->post('emp_id'),
                'net'            => $this->input->post('net'),
                'base_salary'    => $this->input->post('base'),
            ];
            
            $this->load->model("EmployeeModel");
            $this->EmployeeModel->insertOperation($data);
             
            $dataSalary= [
                'salary' => $this->input->post('salary')
            ];
            // print_r($_POST);
            // die;
            $id = $this->input->post('emp_id');
            $this->EmployeeModel->updateEmployee($dataSalary, $id);

            $this->load->view('template/header');
            redirect(base_url('employee/manageSalary'));

             // $data = file_get_contents("php://input");
            // if (!$this->input->is_ajax_request()) {
            //     exit('No direct script access allowed');
            // }
            //  $data=[
            //     'salary' => $this->input->post('valSalary')
            //  ];
            //  $this->dd($data);
        
    }

    public function edit($id)
    {
        $this->load->view('template/header');
        $this->load->model("EmployeeModel");
        $data['employee'] = $this->EmployeeModel->editEmployee($id);
        $this->load->view('frontend/edit', $data);
        $this->load->view('template/footer');
    }

    public function update($id)
    {

        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('salary', 'salary', 'required');

        if ($this->form_validation->run()) :

            $data = [
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'phone'      => $this->input->post('phone'),
                'email'      => $this->input->post('email'),
                'salary'      => $this->input->post('salary'),

            ];
            $this->load->model("EmployeeModel");
            $this->EmployeeModel->updateEmployee($data, $id);
            redirect(base_url('employee'));
        else :
            $this->edit($id);
        endif;
    }

    public function manageSalary()
    {
        $this->load->view('template/header');
        $this->load->model("EmployeeModel");
        $data['manageSalary'] = $this->EmployeeModel->joinAll();
        // $this->dd($data['manageSalary']);
        $this->load->view('frontend/manage_salary', $data);
        $this->load->view('template/footer');
    }


    public function delete($id)
    {
        $this->load->model('EmployeeModel');
        $this->EmployeeModel->deleteEmployee($id);
        redirect(base_url('employee'));
    }

    public function deleteOperation($id)
    {
        $this->load->model('EmployeeModel');

        $data = $this->EmployeeModel->getOperation($id);
        $salary = $this->EmployeeModel->joinSalary($id);
        $test = json_decode(json_encode($salary), true);
        $oldSalary=$test[0]['salary'];
        $userId=$test[0]['id'];
         
        // $this->dd($salary);
        // print_r($netSalary);
        // die;
        if($data->operation_type == 'fixed'){
            if($data->operation == 'income'){
                $newSalary = $oldSalary - $data->amount;
            }else if($data->operation == 'deduction'){
                $newSalary = $oldSalary + $data->amount;
            }
        }else if($data->operation_type == 'percentage'){
            if($data->operation == 'income'){
                $newSalary  = $oldSalary - ($oldSalary*($data->amount*0.01));
            }else if($data->operation == 'deduction'){
                $newSalary = $oldSalary + ($oldSalary*($data->amount*0.01));
            }
        }
        $data= [
            'salary' => $newSalary
        ];
        //  print_r($test);
        // die;
        $this->EmployeeModel->updateEmployee($data, $userId);
        $this->EmployeeModel->deletOperation($id);
        redirect(base_url('employee/manageSalary'));
    }

    public function search()
    {
      
            if ($this->input->post('search')) {
                // $this->dd();
                $key = $this->input->post('search');
                $this->load->model('EmployeeModel');
                $detail = $this->EmployeeModel->search($key);
                $data['results'] = $detail;
                $data['join_table'] = $this->EmployeeModel->join($key);
                $this->load->view('template/header');
                $this->load->view('frontend/searchResult', $data);
            }

    }

    public function report($id){
        $this->load->model('EmployeeModel');
        $data['employee']   = $this->EmployeeModel->search($id);
        $data['operations'] = $this->EmployeeModel->joinMonth($id);
        $this->load->view('template/header');
        $this->load->view('frontend/report', $data);

    }
}
