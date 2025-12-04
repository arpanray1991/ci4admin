<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\AdminuserModel;
use App\Models\Admin\UiBookmarkModel; 
use App\Models\Admin\ScopesModel;

class AdminuserController extends BaseController
{
    protected $adminuserModel;

    public function __construct()
    {
        helper('Admin/data_helper');
        $this->adminuserModel = new AdminuserModel();
    }

    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/admin/login');
        }
        helper('Admin/data_helper');
        $user_id = session()->get('user_id');
        
        $status = $this->request->getGet('status');

        $hide_fields_data = getUiBookmark($user_id, 'adminuser');
        if($hide_fields_data){
            $hide_fields = json_decode($hide_fields_data['hide_fields']);
        } else {
            $hide_fields = [];
        }

        if ($status == 'active') {
            $adminusers = $this->adminuserModel->where('status', 1)
                                         ->where('id !=', $user_id)
                                         ->findAll();
        } elseif ($status == 'inactive') {
            $adminusers = $this->adminuserModel->where('status', 2)
                                         ->where('id !=', $user_id)
                                         ->findAll();
        } else {
            $adminusers = $this->adminuserModel->where('id !=', $user_id)
                                         ->findAll(); // All by default
        }
        $data['adminusers'] = $adminusers;
        $data['hide_fields'] = (array)$hide_fields;

        return view('admin/adminUsers_grid', $data);
    }

    public function create()
    {
        $scopesModel = new ScopesModel();
        $scopes = $scopesModel->where('status', 1)->findAll();
        $data['statusOptions'] = getStatusOption();
        $data['scopes'] = $scopes;
        return view('admin/adminuser_form', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['password'] = $passwordHash;
        $this->adminuserModel->save($data);
        return redirect()->to('/admin/adminusers');
    }

    public function edit($id)
    {
        $data['adminuser'] = $this->adminuserModel->find($id);
        $data['statusOptions'] = getStatusOption();
        $scopesModel = new ScopesModel();
        $scopes = $scopesModel->where('status', 1)->findAll();
        $data['scopes'] = $scopes;
        return view('admin/adminuser_form', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $this->adminuserModel->update($id, $data);
        return redirect()->to('/admin/adminusers');
    }

    public function delete($id)
    {
        $this->adminuserModel->delete($id);
        return redirect()->to('/admin/adminusers');
    }

    public function fieldShowHide()
    {
        $field_id = $_POST['field_id'];
        $is_checked = $_POST['is_checked'];

        $user_id = session()->get('user_id');
        $uiBookmarkModel = new UiBookmarkModel();
        $hide_fields_data = $uiBookmarkModel->where('grid_slug', 'adminuser')
                                 ->where('admin_user_id', $user_id)
                                 ->first();
        if($hide_fields_data) {
            $hide_fields = json_decode($hide_fields_data['hide_fields']);
            $id = $hide_fields_data['id'];
            if($is_checked=='1')
            {
                if(($key = array_search($field_id, $hide_fields)) !== false) {
                    
                    unset($hide_fields[$key]);
                }
            } else {
                $hide_fields[] = $field_id;
            }
            
            $data = [
                'hide_fields' => json_encode($hide_fields)
            ];
            if($uiBookmarkModel->update($id, $data)){
                echo "Updated successfully!";
            } else {
                echo "Update failed!";
            }
        } else {
            $hide_fields[] = $field_id;
            $data['admin_user_id'] = $user_id;
            $data['grid_slug'] = 'adminuser';
            $data['hide_fields'] = json_encode($hide_fields);
            $uiBookmarkModel->save($data);
        }
    }

}
