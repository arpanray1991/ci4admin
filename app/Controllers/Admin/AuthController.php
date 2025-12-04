<?php 

namespace App\Controllers\Admin;

use App\Models\Admin\AdminuserModel;
use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function login()
    {
        return view('admin/auth/login');
    }

    public function loginPost()
    {
        $session = session();
        $model = new AdminuserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'isLoggedIn' => true,
                'scope' => $user['user_scope'],
                //'role' => $user['role']
            ]);
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }

}