<?php

class EmployeeModel extends CI_Model
{
    public function getEmployee()
    {
        $query = $this->db->get('employee');
        return $query->result();
    }
    // get operation for delete

    public function getOperation($id)
    {
        $query = $this->db->get_where('manage_salary', ['id' => $id]);
        return $query->row();
    }
    // get salary for delete
    public function getSalary($id)
    {
        $query = $this->db->get_where('employee', ['id' => $id]);
        return $query->row();
    }

    public function joinSalary($key){
        $this->db->SELECT('employee.salary, employee.id');    
        $this->db->FROM('employee');
        $this->db->JOIN('manage_salary', 'manage_salary.emp_id = employee.id');
        $this->db->WHERE('manage_salary.id', $key);
        return $this->db->get()->result();
        // $query = $this->db->get_where('manage_salary', ['emp_id' => $key]);
        // return $query->row();
    }

    public function insertEmployee($data)
    {
        return $this->db->insert('employee', $data);
    }

    public function insertOperation($data)
    {
        return $this->db->insert('manage_salary', $data);
    }

    public function editEmployee($id)
    {
        $query = $this->db->get_where('employee', ['id' => $id]);
        return $query->row();
    }

    public function updateEmployee($data, $id)
    {
       return $this->db->update('employee', $data, ['id' => $id]);
    }

    public function deleteEmployee($id)
    {
       return $this->db->delete('employee',['id' => $id]);
    }
    public function deletOperation($id)
    {
       return $this->db->delete('manage_salary',['id' => $id]);
    }

    public function getManageSalary()
    {
        $query = $this->db->get('manage_salary');
        return $query->result();

    }

    public function search($key){
        $this->db->select('*');
        $this->db->from('employee');
        $this->db->where('id', $key);
        return $this->db->get()->row();

        // $query = $this->db->get_where('manage_salary', ['emp_id' => $key]);
        // return $query->row();
    }

    public function join($key){
        $this->db->SELECT('*');    
        $this->db->FROM('employee');
        $this->db->JOIN('manage_salary', 'manage_salary.emp_id = employee.id');
        $this->db->WHERE('emp_id', $key);
        return $this->db->get()->result();
        // $query = $this->db->get_where('manage_salary', ['emp_id' => $key]);
        // return $query->row();
    }
    public function joinAll(){
        $this->db->SELECT('*');    
        $this->db->FROM('employee');
        $this->db->JOIN('manage_salary', 'manage_salary.emp_id = employee.id');
        return $this->db->get()->result();
        // $query = $this->db->get_where('manage_salary', ['emp_id' => $key]);
        // return $query->row();
    }

    public function joinMonth($key){
        // $this->db->SELECT('*');    
        // $this->db->FROM('manage_salary');
        // $this->db->WHERE('emp_id', $key);
        // $this->db->order_by('Month(created_at)');
        // $usersTable->groupBy("Month(created_at)");

        // return $this->db->get()->result();


        $query = $this->db->query('select year(created_at) as year, month(created_at) as month, sum(net) as net_operation, base_salary from manage_salary group by year(created_at), month(created_at)');   

            return $query->result();  

    }



}