<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('database');
        $this->call->library('session');
        $this->call->model('UsersModel');
    }

    public function login()
    {
        if ($this->session->has_userdata('auth_user')) {
            redirect('products');
            return;
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim((string) $this->request->post('username', ''));
            $password = (string) $this->request->post('password', '');
            $user = $this->UsersModel->find_by('username', $username);

            if ($user && (int) $user['is_active'] === 1 && password_verify($password, $user['password'])) {
                $this->session->regenerate_on_login(true);
                $this->session->set_userdata('auth_user', [
                    'id'       => (int) $user['id'],
                    'username' => $user['username'],
                    'role'     => $user['role'],
                ]);
                redirect('products');
                return;
            }

            $error = 'Invalid username or password.';
        }

        $this->call->view('login_view', ['error' => $error]);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}