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
        $this->call->library('session');

        // Check if user is logged in
        if (!$this->session->has_userdata('user_id')) {
            header("Location: " . site_url("login"));
            exit;
        }
    }

    public function index()
    {
        try {
            $this->call->library('pagination');
            $this->pagination->set_theme('tailwind');

            // Get current page from URL segment (default to 1)
            if (method_exists($this->io, 'segment')) {
                $page = $this->io->segment(3) ? (int)$this->io->segment(3) : 1;
            } elseif (isset($_GET['page'])) {
                $page = (int) $_GET['page'];
            } else {
                $page = 1;
            }

            // Get search query
            $search = isset($_GET['search']) ? trim($_GET['search']) : '';

            // Set pagination parameters
            $rows_per_page = 5; // Show 5 students per page
            $total_rows = $this->StudentModel->count_all_with_search($search);
            $url = 'students/index';

            // Initialize pagination
            $pagination_data = $this->pagination->initialize($total_rows, $rows_per_page, $page, $url, ['search' => $search]);

            // Get paginated students
            $students = $this->StudentModel->get_paginated_with_search($rows_per_page, ($page - 1) * $rows_per_page, $search);

            $this->call->view('students/index', [
                'students' => $students,
                'pagination' => $this->pagination->paginate(),
                'pagination_info' => $pagination_data['info'],
                'search' => $search,
                'current_page' => $page,
                'user_role' => $this->session->userdata('role'),
                'username' => $this->session->userdata('username')
            ]);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function create()
    {
        if ($this->session->userdata('role') !== 'admin') {
            header("Location: " . site_url("students/index"));
            exit;
        }
        $this->call->view('students/create');
    }

    public function store()
    {
        if ($this->session->userdata('role') !== 'admin') {
            header("Location: " . site_url("students/index"));
            exit;
        }

        $data = [
            'last_name'  => $this->io->post('last_name'),
            'first_name' => $this->io->post('first_name'),
            'email'      => $this->io->post('email')
        ];

        $this->StudentModel->insert($data);

        // Calculate new page after insertion
        $new_count = $this->StudentModel->count_all();
        $rows_per_page = 5;
        $new_page = ceil($new_count / $rows_per_page);

        // Redirect to the page containing the new student
        header("Location: " . site_url("students/index/{$new_page}"));
        exit;
    }

    public function edit($id)
    {
        if ($this->session->userdata('role') !== 'admin') {
            header("Location: " . site_url("students/index"));
            exit;
        }

        $student = $this->StudentModel->find($id);

        if (!$student) {
            echo "Student not found!";
            return;
        }

        $this->call->view('students/edit', ['student' => $student]);
    }

    public function update($id)
    {
        if ($this->session->userdata('role') !== 'admin') {
            header("Location: " . site_url("students/index"));
            exit;
        }

        $page = $this->io->post('page');
        if (!$page) {
            $page = 1;
        }

        $data = [
            'last_name'  => $_POST['last_name'],
            'first_name' => $_POST['first_name'],
            'email'      => $_POST['email']
        ];

        $this->StudentModel->update($id, $data);

        header("Location: " . site_url("students/index/{$page}"));
        exit;
    }


    public function delete($id, $page = 1)
    {
        if ($this->session->userdata('role') !== 'admin') {
            header("Location: " . site_url("students/index"));
            exit;
        }

        // Delete the record
        $this->StudentModel->delete($id);

        // Redirect back to the students list with current page
        header("Location: " . site_url("students/index/{$page}"));
        exit;
    }

    public function delete_all()
    {
        if ($this->session->userdata('role') !== 'admin') {
            header("Location: " . site_url("students/index"));
            exit;
        }

        $this->StudentModel->truncate();
        header("Location: " . site_url("students/index"));
        exit;
    }

}