<?php

namespace App\Http\Controllers;

use Shuchkin\SimpleXLSX;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RekomendasiController extends Controller
{
    public function index(){

        //Organik
        $filePaths = [
            'Organik' => public_path('/files/tokopedia_products_Pupuk_Organik_2024-10-21.xlsx'),
            'Anorganik' => public_path('/files/tokopedia_products_Pupuk_Anorganik_2024-10-21.xlsx'),
            'Cair' => public_path('/files/tokopedia_products_Pupuk_Cair_2024-10-21.xlsx'),
        ];

        // Array untuk menyimpan data
        $data = [];

        foreach ($filePaths as $key => $filePath) {
            if ($xlsx = SimpleXLSX::parse($filePath)) {
                $rows = $xlsx->rows(); // Ambil semua baris
                $headers = array_shift($rows); // Ambil baris pertama sebagai header

                $data[$key]['headers'] = $headers; // Simpan header
                $data[$key]['data'] = array_slice($rows, 5); 

                
            } else {
                return response()->json(['error' => SimpleXLSX::parseError()], 400);
            }
        }


        // dd($data['Cair']);


        return view('rekomendasi.index', compact('data'));
    }
}
