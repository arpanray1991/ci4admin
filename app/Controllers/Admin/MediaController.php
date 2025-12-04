<?php

// app/Controllers/Admin/Media.php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\MediaModel;

class MediaController extends BaseController
{
    public function index()
    {
        $mediaModel = new MediaModel();
        $data['images'] = $mediaModel->orderBy('created_at', 'DESC')->findAll();

        return view('admin/media/gallery', $data);
    }

    public function uploadForm()
    {
        return view('admin/media/upload');
    }

    public function upload()
    {
        $file = $this->request->getFile('image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $mime = $file->getMimeType();
            $newName = $file->getRandomName();
            
            $file->move(ROOTPATH . 'public/uploads', $newName);

            $mediaModel = new MediaModel();
            $mediaModel->insert([
                'file_name' => $newName,
                'file_path' => 'uploads/'.$newName,
                'mime_type' => $mime,
            ]);

            return redirect()->to('/admin/media')->with('success', 'Image uploaded successfully');
        }

        return redirect()->back()->with('error', 'Failed to upload image.');
    }

    public function json()
    {
        $mediaModel = new MediaModel();
        $images = $mediaModel->orderBy('created_at', 'DESC')->findAll();
        //print_r($images); exit;
        return $this->response->setJSON($images);
    }

    public function uploadAjax()
    {
        $file = $this->request->getFile('image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $mime = $file->getMimeType();
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName);

            $mediaModel = new MediaModel();
            $mediaModel->insert([
                'file_name' => $newName,
                'file_path' => base_url('uploads/' . $newName),
                'mime_type' => $mime,
            ]);

            return $this->response->setJSON([
                'success' => true,
                'path' => base_url('uploads/' . $newName)
            ]);
        }

        return $this->response->setJSON(['success' => false]);
    }
}
