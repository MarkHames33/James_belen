<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load UsersModel so it is available as $this->UsersModel
            $this->call->library('database');   
        $this->call->library('session');
        $this->call->model('UsersModel');
    }

    /**
     * Retrieve all users and display them in the view.
     */
    public function index()
    {
        // UsersController -> UsersModel -> all() -> users table records
        $users = $this->UsersModel->all();

        // Pass the retrieved records to the view
        $data['users'] = $users;
        $data['auth_user'] = $this->session->userdata('auth_user');

        // Load the user view
        $this->call->view('users_view', $data);
    }

    public function edit($id)
    {
        $user = $this->UsersModel->find((int) $id);
        if (!$user) {
            $this->response->set_status_code(404);
            $this->call->view('errors/error_404');
            return;
        }

        $this->call->view('user_form_view', [
            'user' => $user,
            'form_action' => 'users/update/' . (int) $id,
            'form_title' => 'Edit a little star',
            'submit_label' => 'Save changes',
        ]);
    }

    public function create()
    {
        $user = [
            'firstname' => '',
            'lastname'  => '',
            'email'     => '',
            'username'  => '',
        ];
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = [
                'firstname' => trim((string) $this->request->post('firstname', '')),
                'lastname'  => trim((string) $this->request->post('lastname', '')),
                'email'     => trim((string) $this->request->post('email', '')),
                'username'  => trim((string) $this->request->post('username', '')),
            ];

            if ($user['firstname'] === '' || $user['lastname'] === '' || !filter_var($user['email'], FILTER_VALIDATE_EMAIL) || $user['username'] === '') {
                $error = 'Please provide valid values for all fields.';
            } else {
                $this->UsersModel->insert(array_merge($user, [
                    'password' => password_hash('Welcome@123', PASSWORD_DEFAULT),
                    'role' => 'user',
                    'is_active' => 1,
                ]));
                redirect('users');
                return;
            }
        }

        $this->call->view('user_form_view', [
            'user' => $user,
            'error' => $error,
            'form_action' => 'users/create',
            'form_title' => 'Add a little star',
            'submit_label' => 'Add user',
        ]);
    }

    public function update($id)
    {
        $data = [
            'firstname' => trim((string) $this->request->post('firstname', '')),
            'lastname'  => trim((string) $this->request->post('lastname', '')),
            'email'     => trim((string) $this->request->post('email', '')),
            'username'  => trim((string) $this->request->post('username', '')),
        ];

        if ($data['firstname'] === '' || $data['lastname'] === '' || !filter_var($data['email'], FILTER_VALIDATE_EMAIL) || $data['username'] === '') {
            $user = $this->UsersModel->find((int) $id);
            $this->call->view('user_form_view', [
                'user' => array_merge($user ?: [], $data),
                'error' => 'Please provide valid values for all fields.',
                'form_action' => 'users/update/' . (int) $id,
                'form_title' => 'Edit a little star',
                'submit_label' => 'Save changes',
            ]);
            return;
        }

        $this->UsersModel->update((int) $id, $data);
        redirect('users');
    }

    public function delete($id)
    {
        $this->UsersModel->delete((int) $id);
        redirect('users');
    }
}