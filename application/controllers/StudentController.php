<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentController extends CI_Controller{

    public  function index()
    {
        $this->load->model('StudentModel');
        // $student = new StudentModel;


        $student = $this->StudentModel->student_data();

        echo 'Student Name: '.$student;
    }

}