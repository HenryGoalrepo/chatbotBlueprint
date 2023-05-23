<?php
namespace ChatBot\Blueprint\Http\Controllers;
use App\Http\Controllers\Controller;
class ChatBotController extends Controller{
    public function bot(){
        return view('chatbotBluePrint::bot');
    }
}




?>
