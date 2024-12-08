<?php

namespace App\Http\Controllers;

use Shuchkin\SimpleXLSX;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function index(Request $request)
    {
        // File paths untuk berbagai kategori pupuk
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
                $data[$key]['data'] = array_slice($rows, 5); // Data dimulai dari baris ke-6
            } else {
                return response()->json(['error' => SimpleXLSX::parseError()], 400);
            }
        }

        // Tangkap parameter pencarian dari request
        $searchQuery = $request->input('search');

        // Variabel untuk menyimpan hasil pencarian
        $searchResults = [];

        if ($searchQuery) {
            foreach ($data as $key => $category) {
                $categoryResults = array_filter($category['data'], function ($row) use ($searchQuery) {
                    // Lakukan pencarian pada nama produk (kolom ke-2)
                    return stripos(strtolower($row[2]), strtolower($searchQuery)) !== false;
                });

                if (!empty($categoryResults)) {
                    $searchResults[$key] = $categoryResults;
                }
            }

            // Jika ada hasil pencarian, gunakan hasil pencarian
            if (!empty($searchResults)) {
                $data = $searchResults;
            }
        }
        // dd($data);

        return view('rekomendasi.index', compact('data', 'searchQuery'));
    }
}
