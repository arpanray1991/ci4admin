<?php

namespace App\Controllers\Admin;

use App\Models\Admin\ModulesModel;
use App\Controllers\BaseController;

class ModuleController extends BaseController {

    public function __construct()
    {
        helper('Admin/data_helper');
    }

    public function index() {
        if (!session()->has('user_id')) {
            return redirect()->to('/admin/login');
        }
        $user_id = session()->get('user_id');
        
        $hide_fields_data = getUiBookmark($user_id, 'module');
        if($hide_fields_data){
            $hide_fields = json_decode($hide_fields_data['hide_fields']);
        } else {
            $hide_fields = [];
        }
        

        $modulesModel = new ModulesModel();
        $status = $this->request->getGet('status');

        if ($status == 'active') {
            $modules = $modulesModel->where('status', 1)->findAll();
        } elseif ($status == 'inactive') {
            $modules = $modulesModel->where('status', 2)->findAll();
        } else {
            $modules = $modulesModel->findAll(); // All by default
        }

        $data['modules'] = $modules;
        $data['hide_fields'] = (array)$hide_fields;

        return view('admin/module_grid', $data);
    }

    public function create()
    {
        $data['statusOptions'] = getStatusOption();
        return view('admin/module_form', $data);
    }

    public function store()
    {
        $model = new ModulesModel();
        $data = $this->request->getPost();
        $store_data['module_name'] = $data['module_name'];
        $functionality = [];
        if(isset($data['add'])){
            $functionality[] = 'add';
        }
        if(isset($data['view'])){
            $functionality[] = 'view';
        }
        if(isset($data['edit'])){
            $functionality[] = 'edit';
        }
        if(isset($data['delete'])){
            $functionality[] = 'delete';
        }
        $store_data['functionality'] = json_encode($functionality);
        $store_data['status'] = $data['status'];
        $model->save($store_data);
        return redirect()->to('/admin/modules');
    }

    public function edit($id)
    {
        $model = new ModulesModel();
        $data['module'] = $model->find($id);
        $functionality = json_decode($data['module']['functionality']);
        $data['module']['operations'] = $functionality;
        $data['statusOptions'] = getStatusOption();
        return view('admin/module_form', $data);
    }

    public function update($id)
    {
        $model = new ModulesModel();
        $data = $this->request->getPost();
        $store_data['module_name'] = $data['module_name'];
        $functionality = [];
        if(isset($data['add'])){
            $functionality[] = 'add';
        }
        if(isset($data['view'])){
            $functionality[] = 'view';
        }
        if(isset($data['edit'])){
            $functionality[] = 'edit';
        }
        if(isset($data['delete'])){
            $functionality[] = 'delete';
        }
        $store_data['functionality'] = json_encode($functionality);
        $store_data['status'] = $data['status'];
        $model->update($id, $store_data);
        return redirect()->to('/admin/modules');
    }

    public function delete($id)
    {
        $model = new ModulesModel();
        $model->delete($id);
        return redirect()->to('/admin/modules');
    }
}