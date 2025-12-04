<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\Writer\SvgWriter;
use App\Models\QrDataModel;
use App\Models\QrScanModel;
use CodeIgniter\Files\File;

class QrCodeController extends BaseController
{
    public function generate($text = 'https://example.com')
    {
        $decodedText = urldecode($text);

        // ✅ Create QR code object (no setSize/setMargin)
        $qrCode = new QrCode($decodedText);
        //$qrCode->setEncoding(new Encoding('UTF-8'));
        //$qrCode->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh());

        // ✅ Create writer and generate PNG with custom size and margin
        $writer = new SvgWriter();
        $result = $writer->write($qrCode);

        return $this->response
            ->setHeader('Content-Type', $result->getMimeType())
            ->setBody($result->getString());
    }

    public function getQr() {
        $qr_text = $_POST['qr_text'];
        $qr_hash = substr(md5($qr_text.uniqid('',true)),0,20);
        $short_code = base_url().'qrRedirect/'.$qr_hash;

        $decodedText = urldecode($short_code);

        // Create QR code instance
        $qrCode = new QrCode($decodedText);

        // Generate SVG
        $writer = new SvgWriter();
        $result = $writer->write($qrCode);

        $uploadPath = FCPATH . 'uploads/qr_images/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // ✅ Save SVG to file
        $filename = 'qr_' . date('Y-m-d') .'_'. time() . '.svg'; // dynamic filename
        $filePath = $uploadPath . $filename;

        // Save the image
        $result->saveToFile($filePath);

        // Return image directly (optional)
        /*return $this->response
            ->setHeader('Content-Type', $result->getMimeType())
            ->setBody($result->getString());*/
            
        $qrDataModel = new QrDataModel();
        $data['user_id'] = '';
        $data['qr_text'] = $qr_text;
        $data['image_url'] = 'uploads/qr_images/'.$filename;
        $data['qr_hash'] = $qr_hash;
        $qrDataModel->save($data);

        return base_url().'uploads/qr_images/'.$filename;

    }

    public function qrRedirect($qr_hash) {
        $qrDataModel = new QrDataModel();
        $qrData = $qrDataModel->where('qr_hash', $qr_hash)->first();
        $this->qrScan($qrData['id']);
        return redirect()->to($qrData['qr_text']);
    }

    private function qrScan($id)
    {
        $agent = $this->request->getUserAgent();
        $qrScanModel = new QrScanModel();
        $qrScanModel->insert([
            'qr_data_id' => $id,
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $agent->getAgentString(),
            'platform' => $agent->getPlatform(),
            'browser' => $agent->getBrowser() . ' ' . $agent->getVersion(),
        ]);
    }
}
