<?php
use Illuminate\Support\Facades\Route;
use ChatBot\Blueprint\Http\Controllers\ChatBotController;
use ChatBot\Blueprint\Http\Controllers\Chatbot\Coversationflow;
Route::get('/chatbot',[ChatBotController::class,'bot'])->name('chatbot.bots');

Route::get('/test',function(){
  dd('packgist loaded');
});

Route::get('/test/autoload',function(){
    dd('this is for autodisconery packgist and tag');
  });

Route::resource('conversationflow',Coversationflow::class);


?>
