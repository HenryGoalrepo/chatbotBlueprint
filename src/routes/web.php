<?php
use Illuminate\Support\Facades\Route;
use ChatBot\Blueprint\Http\Controllers\ChatBotController;
use ChatBot\Blueprint\Http\Controllers\Chatbot\Coversationflow;
Route::get('/chatbot',[ChatBotController::class,'bot'])->name('chatbot.bots');


Route::resource('conversationflow',Coversationflow::class);


?>
