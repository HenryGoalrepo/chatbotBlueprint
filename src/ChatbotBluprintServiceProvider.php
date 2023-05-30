<?php
namespace ChatBot\Blueprint;
use Illuminate\Support\ServiceProvider;
class ChatbotBluprintServiceProvider extends ServiceProvider{

     public function boot():void{

          $this->loadRoutesFrom(__DIR__.'/routes/web.php');
          $this->loadViewsFrom(__DIR__.'/resources/views','chatbotBluePrint');
          $this->loadMigrationsFrom(__DIR__.'/database/migrations');
          $this->publishes([
            __DIR__.'/database/migrations/2023_05_30_065733_create_entities_table.php'=>
            $this->app->databasePath(now()->format('Y_m_d_His').'_create_entities_table'),
          ],'migrations');

     }
     public function register(){


     }

}


?>
