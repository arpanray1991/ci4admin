<?php 

namespace App\Controllers\Admin;

use App\Models\Admin\ProductModel;
use App\Models\Admin\UiBookmarkModel;
use App\Controllers\BaseController;

class ProductController extends BaseController
{
    public function __construct()
    {
        helper('Admin/data_helper');
    }

    public function index()
    {   
        if (!session()->has('user_id')) {
            return redirect()->to('/admin/login');
        }
        if(!checkSuperAdmin() && !checkModuleInScope('Products')) { return redirect()->to('/admin/dashboard'); }
        $user_id = session()->get('user_id');
        
        $hide_fields_data = getUiBookmark($user_id, 'product');
        if($hide_fields_data){
            $hide_fields = json_decode($hide_fields_data['hide_fields']);
        } else {
            $hide_fields = [];
        }
        

        $productModel = new ProductModel();
        $status = $this->request->getGet('status');

        if ($status == 'active') {
            $products = $productModel->where('status', 1)->findAll();
        } elseif ($status == 'inactive') {
            $products = $productModel->where('status', 2)->findAll();
        } else {
            $products = $productModel->findAll(); // All by default
        }
        $data['products'] = $products;
        $data['hide_fields'] = (array)$hide_fields;

        return view('admin/products_grid', $data);
    }

    public function create()
    {
        $data['statusOptions'] = getStatusOption();
        return view('admin/product_form', $data);
    }

    public function store()
    {
        $model = new ProductModel();
        $data = $this->request->getPost();
        $model->save($data);
        return redirect()->to('/admin/products');
    }
    
    public function edit($id)
    {
        $model = new ProductModel();
        $data['product'] = $model->find($id);
        $data['statusOptions'] = getStatusOption();
        return view('admin/product_form', $data);
    }

    public function update($id)
    {
        $model = new ProductModel();
        $data = $this->request->getPost();
        $model->update($id, $data);
        return redirect()->to('/admin/products');
    }

    public function delete($id)
    {
        $model = new ProductModel();
        $model->delete($id);
        return redirect()->to('/admin/products');
    }

    public function fieldShowHide()
    {
        $field_id = $_POST['field_id'];
        $is_checked = $_POST['is_checked'];

        $user_id = session()->get('user_id');
        $uiBookmarkModel = new UiBookmarkModel();
        $hide_fields_data = $uiBookmarkModel->where('grid_slug', 'product')
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
            $data['grid_slug'] = 'product';
            $data['hide_fields'] = json_encode($hide_fields);
            $uiBookmarkModel->save($data);
        }
    }
}
?>