<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\AdminuserModel;
use App\Models\QrDataModel; 
use App\Models\QrScanModel; 
use App\Models\Admin\UiBookmarkModel; 

class QrController extends BaseController
{
    protected $qrDataModel;
    
    public function __construct()
    {
        helper('Admin/data_helper');
        $this->qrDataModel = new QrDataModel();
        $this->qrScanModel = new QrScanModel();
    }
    
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/admin/login');
        }
        $user_id = session()->get('user_id');
        
        $status = $this->request->getGet('status');

        $hide_fields_data = getUiBookmark($user_id, 'qr');
        if($hide_fields_data){
            $hide_fields = json_decode($hide_fields_data['hide_fields']);
        } else {
            $hide_fields = [];
        }

        if ($status == 'active') {
            $qr_data = $this->qrDataModel->where('status', 1)
                                         ->findAll();
        } elseif ($status == 'inactive') {
            $qr_data = $this->qrDataModel->where('status', 2)
                                         ->findAll();
        } else {
            $qr_data = $this->qrDataModel->findAll(); // All by default
        }
        $data['qr_data'] = $qr_data;
        $data['hide_fields'] = (array)$hide_fields;

        return view('admin/qr_grid', $data);
    }

    public function view($id)
    {
        $data['qr_data'] = $this->qrDataModel->find($id);
        if($data['qr_data']['user_id']=='0') {
            $data['qr_data']['user_name'] = "Guest";
        }
        $data['qr_scan'] = $this->qrScanModel->where('qr_data_id', $id)->findAll();
        $data['qr_scan_count'] = count($data['qr_scan']);
        $data['statusOptions'] = getStatusOption();
        return view('admin/qr_view', $data);
    }

    public function delete($id)
    {
        $this->qrDataModel->delete($id);
        return redirect()->to('/admin/qr_data');
    }

    public function fieldShowHide()
    {
        $field_id = $_POST['field_id'];
        $is_checked = $_POST['is_checked'];

        $user_id = session()->get('user_id');
        $uiBookmarkModel = new UiBookmarkModel();
        $hide_fields_data = $uiBookmarkModel->where('grid_slug', 'qr')
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
            $data['grid_slug'] = 'qr';
            $data['hide_fields'] = json_encode($hide_fields);
            $uiBookmarkModel->save($data);
        }
    }
}
