<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: Auth
 */
class Auth extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('UserModel');
        $this->call->library('session');
    }

    public function login()
    {
        // If already logged in, redirect to students
        if ($this->session->has_userdata('user_id')) {
            header("Location: " . site_url("students/index"));
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');

            if (empty($username) || empty($password)) {
                $this->session->set_flashdata('error', 'Please enter both username and password.');
                header("Location: " . site_url("login"));
                exit;
            }

            $user = $this->UserModel->find_by_username($username);

            if ($user && password_verify($password, $user['password'])) {
                // Set session data
                $this->session->set_userdata('user_id', $user['id']);
                $this->session->set_userdata('username', $user['username']);
                $this->session->set_userdata('role', $user['role']);

                header("Location: " . site_url("students/index"));
                exit;
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password.');
                header("Location: " . site_url("login"));
                exit;
            }
        } else {
            // Show login form
            $error = $this->session->flashdata('error');
            $this->call->view('auth/login', ['error' => $error]);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        header("Location: " . site_url("login"));
        exit;
    }
}
