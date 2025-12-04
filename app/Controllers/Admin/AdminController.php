<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function dashboard()
    {
    	if (!session()->get('isLoggedIn')) {
	        return redirect()->to('/admin/login');
	    }
        return view('admin/dashboard');
    }
}