<?php
use Illuminate\Support\Facades\Route;
use ChatBot\Blueprint\Http\Controllers\ChatBotController;
use ChatBot\Blueprint\Http\Controllers\Chatbot\Coversationflow;

Route::resource('conversationflow',Coversationflow::class);


?>
