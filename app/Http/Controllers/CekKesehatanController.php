<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\RequestException;

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
        $photoData = base64_decode($photoData);

        // Simpan foto ke penyimpanan
        $fileName = Str::random(10) . '.jpg';
        Storage::put('public/photos/' . $fileName, $photoData);

        // Dapatkan URL gambar
        $filePath = 'public/photos/' . $fileName;
        $imageUrl = Storage::url($filePath);

        // Inisialisasi Guzzle HTTP client
        $client = new Client();

        try {
            // Kirim permintaan POST ke API
            $response = $client->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=AIzaSyBCm3oJuCL8Et2QCPSWg3wb0ux8fBSeKEM' . env('GEMINI_API_KEY'), [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    "contents" => [
                        [
                            "parts" => [
                                [
                                    "text" => "apa yang ada di dalam gambar ini? deskripsikan dengan detail mengenai gambar ini"
                                ],
                                [
                                    "inline_data" => [
                                        "mime_type" => "image/jpeg",
                                        "data" => base64_encode($photoData)  // Menggunakan data base64 gambar
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

            // Redirect dengan data hasil API dan URL gambar
            return redirect()->route('cek-kesehatan.hasil')->with([
                'result' => $description,
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