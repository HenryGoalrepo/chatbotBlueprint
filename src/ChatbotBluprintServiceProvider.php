<?php
namespace ChatBot\Blueprint;
use Illuminate\Support\ServiceProvider;
class ChatbotBluprintServiceProvider extends ServiceProvider{

     public function boot():void{

          $this->loadRoutesFrom(__DIR__.'/routes/web.php');
          $this->loadViewsFrom(__DIR__.'/resources/views','chatbotBluePrint');

     }
     public function register(){


     }

}


?>
