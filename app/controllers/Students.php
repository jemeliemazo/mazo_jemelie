<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: Students
 * 
 * Automatically generated via CLI.
 */
class Students extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('StudentModel');
    }

    public function index()
    {
        $this->call->library('pagination');
        $this->pagination->set_theme('tailwind');

        // Get current page from URL segment (default to 1)
        $page = $this->io->segment(3) ? (int)$this->io->segment(3) : 1;

        // Set pagination parameters
        $rows_per_page = 5; // Show 5 students per page
        $total_rows = $this->StudentModel->count_all();
        $url = 'students/index';

        // Initialize pagination
        $pagination_data = $this->pagination->initialize($total_rows, $rows_per_page, $page, $url);

        // Get paginated students
        $students = $this->StudentModel->get_paginated($rows_per_page, ($page - 1) * $rows_per_page);

        $this->call->view('students/index', [
            'students' => $students,
            'pagination' => $this->pagination->paginate(),
            'pagination_info' => $pagination_data['info']
        ]);
    }

    public function create()
    {
        $this->call->view('students/create');
    }

    public function store()
    {
        $data = [
            'last_name'  => $this->io->post('last_name'),
            'first_name' => $this->io->post('first_name'),
            'email'      => $this->io->post('email')
        ];

        $this->StudentModel->insert($data);

        // Redirect to students list
        header("Location: /index.php/students/index");
        exit;
    }

    public function edit($id)
    {
        $student = $this->StudentModel->find($id);

        if (!$student) {
            echo "Student not found!";
            return;
        }

        $this->call->view('students/edit', ['student' => $student]);
    }

    public function update($id)
    {
        $data = [
            'last_name'  => $_POST['last_name'],
            'first_name' => $_POST['first_name'],
            'email'      => $_POST['email']
        ];

        $this->StudentModel->update($id, $data);

        header("Location: /index.php/students/index");
        exit;
    }


    public function delete($id)
    {
        // Delete the record
        $this->StudentModel->delete($id);

        // Redirect back to the students list
        header('Location: /index.php/students/index');
        exit;
    }

    public function delete_all()
    {
        $this->StudentModel->truncate();
        header("Location: /index.php/students/index");
        exit;
    }

}