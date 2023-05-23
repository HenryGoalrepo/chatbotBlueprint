<?php
use Illuminate\Support\Facades\Route;
use ChatBot\Blueprint\Http\Controllers\ChatBotController;

Route::get('/chatbot',[ChatBotController::class,'bot'])->name('chatbot.bots');


?>
