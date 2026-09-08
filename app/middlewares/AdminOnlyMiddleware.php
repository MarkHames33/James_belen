<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AdminOnlyMiddleware
{
    public function handle($next)
    {
        $lava = lava_instance();
        $lava->call->library('session');

        $user = $lava->session->userdata('auth_user');
        if (($user['role'] ?? '') !== 'admin') {
            $lava->response->set_status_code(403);
            $lava->call->view('errors/error_403');
            return;
        }

        return $next();
    }
}