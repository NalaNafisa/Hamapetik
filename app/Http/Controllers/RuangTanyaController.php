<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class RuangTanyaController extends Controller
{
    public function index()
    {
        // Find or create a conversation for the authenticated user
        $conversation = Conversation::firstOrCreate(['user_id' => Auth::id()]);

        // Get all messages for this conversation
        $messages = $conversation->messages()->orderBy('created_at', 'asc')->get();

        return view('ruangbertanya.index', compact('messages'));
    }

    public function callChatbotAPI($message)
    {
        Log::info('Calling chatbot API with message', ['message' => $message]);
    
        $client = new Client();
        try {
            // Kirim permintaan POST ke API
            $response = $client->post('AIzaSyATpx6W1uWyPw7ymXobT9YG5CmEPLoxDw8' . env('GEMINI_API_KEY'), [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    "contents" => [
                        [
                            "parts" => [
                                [
                                    "text" => $message
                                ],
                            ]
                        ]
                    ],
                ]
            ]);
    
            // Dapatkan respons dari API
            $responseBody = json_decode($response->getBody(), true);
            
            // Validasi respons API
            if (isset($responseBody['candidates'][0]['content']['parts'][0]['text'])) {
                return $responseBody['candidates'][0]['content']['parts'][0]['text'];
            } else {
                return "Error: Response structure is invalid.";
            }
        } catch (RequestException $e) {
            // Tangani pengecualian permintaan
            Log::error('API request failed', ['error' => $e->getMessage()]);
            if ($e->hasResponse()) {
                $errorResponse = $e->getResponse()->getBody()->getContents();
                $errorData = json_decode($errorResponse, true);
                return response()->json(['error' => $errorData], 500);
            } else {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
    
    public function sendMessage(Request $request)
{
    Log::info('Send message initiated', ['user_id' => Auth::id(), 'content' => $request->input('content')]);

    // Find or create a conversation
    $conversation = Conversation::firstOrCreate(['user_id' => Auth::id()]);

    // Save user message
    $userMessage = new Message([
        'conversation_id' => $conversation->id,
        'sender' => 'user',
        'content' => $request->input('content')
    ]);
    $userMessage->save();

    Log::info('User  message saved', ['message_id' => $userMessage->id]);

    // Call chatbot API and save response
    $responseContent = $this->callChatbotAPI($request->input('content'));

    $botMessage = new Message([
        'conversation_id' => $conversation->id,
        'sender' => 'bot',
        'content' => $responseContent
    ]);
    $botMessage->save();

    Log::info('Bot response saved', ['message_id' => $botMessage->id]);

    return response()->json($responseContent);
}

    public function deleteHistory()
    {
        // Find the user's conversation
        $conversation = Conversation::where('user_id', Auth::id())->first();

        if ($conversation) {
            // Delete all messages related to the conversation
            $conversation->messages()->delete();

            // Delete the conversation itself
            $conversation->delete();

            return response()->json(['message' => 'Chat history deleted successfully.']);
        } else {
            return response()->json(['error' => 'No conversation found for the user.'], 404);
        }
    }
}
