<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\RequestException;
use Parsedown;

class CekKesehatanController extends Controller
{
    public function index()
    {
        return view('cekkesehatan.index');
    }

    public function uploadPhoto(Request $request)
    {
        // Ambil data foto dari permintaan
        $photoData = $request->input('photo');
        
        // Dekode data base64
        list($type, $photoData) = explode(';', $photoData);
        list(, $photoData) = explode(',', $photoData);
        $imageDecoded = $photoData;
        // dd($imageDecoded);
        // $photoData = base64_decode($photoData);

        // $extension = explode("/", mime_content_type($imageDecoded))[1]; // Mengambil
        // Simpan foto ke penyimpanan
        $fileName = Str::random(10) . '.jpg';

        Storage::put('public/photos/' . $fileName, base64_decode($imageDecoded));
        
        // Dapatkan URL gambar
        $filePath = 'public/photos/' . $fileName;
        $imageUrl = Storage::url($filePath);

        // Inisialisasi Guzzle HTTP client
        $client = new Client();

        try {
            // Kirim permintaan POST ke API
            $response = $client->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . env('GEMINI_API_KEY'), [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    "contents" => [
                        [
                            "parts" => [
                                [
                                    "text" => "berikan penjelasan dalam bahasa indonesia Apa jenis tanaman yang terkena penyakit?berikan penjelasan singkat tengtang penyakit yang dialami tanaman tersebut Apakah penyebab dari penyakitnya?berikan jenis perawatan dan pengobatan nya dan rekomendasi jenis atau kandungan obat untuk menangani penyakitnya jelas kan jika itu bukan sebuah gambar atau foto tanaman berikan penjelasan tengtang gambar itu dan apa yang terjadi pada benda itu ata kerusakan yang terjadi pada benda itu "
                                ],
                                [
                                    "inline_data" => [
                                        "mime_type" => "image/jpeg",
                                        "data" => $imageDecoded  // Menggunakan data base64 gambar
                                    ]
                                ]
                            ]
                        ]
                    ],
                ]
            ]);

            // Dapatkan respons dari API
            $responseBody = json_decode($response->getBody(), true);

            // Ambil teks dari respons
            $description = $responseBody['candidates'][0]['content']['parts'][0]['text'];
            $Parsedown = new Parsedown();

            $markedDesc = $Parsedown->text($description);

            // Redirect dengan data hasil API dan URL gambar
            return redirect()->route('cek-kesehatan.hasil')->with([
                'result' => $markedDesc,
                'image' => $imageUrl,
            ]);
        } catch (RequestException $e) {
            // Tangani pengecualian permintaan
            if ($e->hasResponse()) {
                $errorResponse = $e->getResponse()->getBody()->getContents();
                $errorData = json_decode($errorResponse, true);
                return redirect()->back()->with('errorData', $errorData);
            } else {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }

    public function hasil()
    {
        return view('cekkesehatan.hasil');
    }
}