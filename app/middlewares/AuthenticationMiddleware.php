<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthenticationMiddleware
{
    public function handle($next)
    {
        $lava = lava_instance();
        $lava->call->library('session');

        $user = $lava->session->userdata('auth_user');
        if (empty($user) || empty($user['id'])) {
            redirect('login');
            return;
        }

        return $next();
    }
}