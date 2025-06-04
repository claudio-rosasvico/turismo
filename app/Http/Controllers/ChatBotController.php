<?php

namespace App\Http\Controllers;

use App\Services\ChatbotService;
use Illuminate\Http\Request;

class ChatBotController extends Controller
{
    public function handleQuery(Request $request) {
        $userQuestion = $request->input('question');
        $userId = auth()->id(); // Si usas autenticación
    
        $response = (new ChatbotService())->handleQuestion($userQuestion, $userId);
        
        return response()->json([
            'answer' => $response,
        ]);
    }
}
