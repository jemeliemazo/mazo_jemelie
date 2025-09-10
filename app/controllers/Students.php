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
        $students = $this->StudentModel->get_all(); 
        $this->call->view('students/index', ['students' => $students]);
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
        header("Location: /students/index");
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

        header("Location: /students/index");
        exit;
    }


    public function delete($id)
    {
        // Delete the record
        $this->StudentModel->delete($id);

        // Redirect back to the students list
        header('Location: /students/index');
        exit;
    }

    public function delete_all()
    {
        $this->StudentModel->truncate();
        header("Location: /students/index");
        exit;
    }

}