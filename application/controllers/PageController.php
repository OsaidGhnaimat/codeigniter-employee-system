<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageController extends CI_Controller
{
    public function index()
    {
        echo "I am index method - page controller - Home in URL";
    }

    public function aboutUs()
    {
        echo "I am aboutUs method - page controller";
    }

    public function blog($blog_url = '')
    {
        echo "$blog_url";
        $this->load->view('blogview');
    }

    public function demo()
    {
        $data['title'] = "Hello. I am osaid web dev";
        $this->load->view('demoPage', $data);
    }
}
