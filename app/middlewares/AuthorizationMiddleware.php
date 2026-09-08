<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthorizationMiddleware
{
    public function handle($next)
    {
        $lava = lava_instance();
        $lava->call->library('session');

        $user = $lava->session->userdata('auth_user');
        if (!in_array($user['role'] ?? '', ['admin', 'moderator'], true)) {
            $lava->response->set_status_code(403);
            $lava->call->view('errors/error_403');
            return;
        }

        return $next();
    }
}