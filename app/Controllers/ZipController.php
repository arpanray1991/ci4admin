<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ZipController extends BaseController {

    public function index() {
        return view('frontend/zip_upload_form');
    }

    public function process_excel() {
        ini_set('max_execution_time', 300);
        $area_name = $this->request->getPost('area_name');
        $file = $_FILES['excel_file']['tmp_name'];

        if (!$file || !$area_name) {
            show_error('Please upload an Excel file and enter an area name.');
        }

        // Step 1: Read Excel
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        //print_r($rows); exit;

        // Step 2: Get Area Coordinates
        $areaCoords = $this->getCoordinates($area_name);
        //print_r($areaCoords); exit;
        if (!$areaCoords) {
            show_error('Area not found.');
        }

        list($areaLat, $areaLng) = $areaCoords;

        // Step 3: Process ZIPs
        $filteredZips = [];
        foreach ($rows as $row) {
            $zip = $row[0];
            if (!$zip) continue;

            $zipCoords = $this->getCoordinates($zip);
            if (!$zipCoords) continue;

            list($zipLat, $zipLng) = $zipCoords;
            echo $areaLat.'----'.$areaLng.'----'.$zipLat.'----'.$zipLng;
            $areaLat = "42.3404";
            $areaLng = "72.4968";
            $zipLat = "38.9121";
            $zipLng = "77.0190";
            echo '<br>';
            echo $areaLat.'----'.$areaLng.'----'.$zipLat.'----'.$zipLng;
            exit;
            $distance = $this->getDistanceMiles($areaLat, $areaLng, $zipLat, $zipLng);
            echo $distance; exit;
            if ($distance <= 15) {
                $filteredZips[] = [$zip, round($distance, 2)];
            }
        }

        // Step 4: Export result Excel
        $newSpreadsheet = new Spreadsheet();
        $sheet = $newSpreadsheet->getActiveSheet();
        $sheet->fromArray(['ZIP Code', 'Distance (miles)'], NULL, 'A1');
        $sheet->fromArray($filteredZips, NULL, 'A2');

        $writer = IOFactory::createWriter($newSpreadsheet, 'Xlsx');
        $filename = 'filtered_zips.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $writer->save('php://output');
    }

    private function getCoordinates($address) {
        //$address = $this->request->getGet('address');
        $url = "https://nominatim.openstreetmap.org/search?q=" . urlencode($address) . "&format=json&limit=1";

        $opts = [
            "http" => [
                "header" => "User-Agent: CodeIgniterApp/1.0\r\n"
            ]
        ];
        $context = stream_context_create($opts);
        $response = file_get_contents($url, false, $context);
        $data = json_decode($response, true);

        if (!empty($data)) {
            /*return $this->response->setJSON([
                'address' => $address,
                'latitude' => $data[0]['lat'],
                'longitude' => $data[0]['lon']
            ]);*/
            return [(float)$data[0]['lat'], (float)$data[0]['lon']];
        } else {
            return $this->response->setJSON(['error' => 'No results found']);
        }
    }

    private function getDistanceMiles($lat1, $lon1, $lat2, $lon2) {
        $earthRadius = 3958.8; // miles
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $earthRadius * $angle;
    }
}
