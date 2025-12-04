<?php

namespace App\Controllers\Admin;

use App\Models\Admin\ScopesModel;
use App\Controllers\BaseController;
use App\Models\Admin\ModulesModel;

class ScopeController extends BaseController {

    public function __construct()
    {
        helper('Admin/data_helper');
    }

    public function index() {
        if (!session()->has('user_id')) {
            return redirect()->to('/admin/login');
        }
        $user_id = session()->get('user_id');
        
        $hide_fields_data = getUiBookmark($user_id, 'scope');
        if($hide_fields_data){
            $hide_fields = json_decode($hide_fields_data['hide_fields']);
        } else {
            $hide_fields = [];
        }
        

        $scopesModel = new ScopesModel();
        $status = $this->request->getGet('status');

        if ($status == 'active') {
            $scopes = $scopesModel->where('status', 1)->findAll();
        } elseif ($status == 'inactive') {
            $scopes = $scopesModel->where('status', 2)->findAll();
        } else {
            $scopes = $scopesModel->findAll(); // All by default
        }

        $data['scopes'] = $scopes;
        $data['hide_fields'] = (array)$hide_fields;

        return view('admin/scope_grid', $data);
    }

    public function create()
    {
        $modulesModel = new ModulesModel();
        $modules = $modulesModel->where('status', 1)->findAll();
        $data['statusOptions'] = getStatusOption();
        $data['modules'] = $modules;
        return view('admin/scope_form', $data);
    }

    public function store()
    {
        $model = new ScopesModel();
        $data = $this->request->getPost();
        $modulesModel = new ModulesModel();
        $modules = $modulesModel->where('status', 1)->findAll();
        $permissions = [];
        foreach($modules as $module)
        {
            $module_permission = [];
            if(isset($data['module_'.$module['id']])){
                $module_permission['module_name'] = $module['module_name'];
                $module_permission['module_action'] = implode(',',$data[$module['id'].'_action']);
            }
            if(!empty($module_permission)){
                $permissions[] = $module_permission;
            }
        }
        $store_data['scope_type'] = $data['scope_type'];
        $store_data['functionality'] = json_encode($permissions);
        $store_data['status'] = $data['status'];
        $model->save($store_data);
        return redirect()->to('/admin/scopes');
    }

    public function edit($id)
    {
        $model = new ScopesModel();
        $modulesModel = new ModulesModel();
        $modules = $modulesModel->where('status', 1)->findAll();
        $data['scope'] = $model->find($id);
        $functionality = json_decode($data['scope']['functionality']);
        $selected_modules = [];
        $selected_action = [];
        foreach($functionality as $key => $fnlty){
            $selected_modules[] = $fnlty->module_name;
            $selected_action[$key] = $fnlty->module_action;
            //print_r(explode(',',$fnlty->module_action)); exit;
        }
        $data['scope']['operations'] = $functionality;
        $data['statusOptions'] = getStatusOption();
        $data['modules'] = $modules;
        $data['selected_modules'] = $selected_modules;
        $data['selected_action'] = $selected_action;
        return view('admin/scope_form', $data);
    }

    public function update($id)
    {
        $model = new ScopesModel();
        $data = $this->request->getPost();
        $modulesModel = new ModulesModel();
        $modules = $modulesModel->where('status', 1)->findAll();
        $permissions = [];
        foreach($modules as $module)
        {
            $module_permission = [];
            if(isset($data['module_'.$module['id']])){
                $module_permission['module_name'] = $module['module_name'];
                $module_permission['module_action'] = implode(',',$data[$module['id'].'_action']);
            }
            if(!empty($module_permission)){
                $permissions[] = $module_permission;
            }
        }
        $store_data['scope_type'] = $data['scope_type'];
        $store_data['functionality'] = json_encode($permissions);
        $store_data['status'] = $data['status'];
        $model->update($id, $store_data);
        return redirect()->to('/admin/scopes');
    }

    public function delete($id)
    {
        $model = new ScopesModel();
        $model->delete($id);
        return redirect()->to('/admin/scopes');
    }
}