<?php
use Illuminate\Support\Facades\Route;
use ChatBot\Blueprint\Http\Controllers\ChatBotController;

Route::get('/chatbot',[ChatBotController::class,'bot'])->name('chatbot.bots');

Route::get('/test',function(){
  dd('packgist loaded');
});

Route::get('/test/autoload',function(){
    dd('this is for autoupdate packgist after push');
  });


?>
