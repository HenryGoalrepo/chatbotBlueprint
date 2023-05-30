<?php
namespace ChatBot\Blueprint;
use Illuminate\Support\ServiceProvider;
class ChatbotBluprintServiceProvider extends ServiceProvider{

     public function boot():void{

          $this->loadRoutesFrom(__DIR__.'/routes/web.php');
          $this->loadViewsFrom(__DIR__.'/resources/views','chatbotBluePrint');
          $this->loadMigrationsFrom(__DIR__.'/database/migrations');

     }
     public function register(){


     }

}


?>
