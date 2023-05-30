<?php
namespace ChatBot\Blueprint;
use ChatBot\Blueprint\Traits\PublishMigration;
use Illuminate\Support\ServiceProvider;
class ChatbotBluprintServiceProvider extends ServiceProvider{
  use PublishMigration;
     public function boot():void{

          $this->loadRoutesFrom(__DIR__.'/routes/web.php');
          $this->loadViewsFrom(__DIR__.'/resources/views','chatbotBluePrint');
          $this->loadMigrationsFrom(__DIR__.'/database/migrations');
          $this->registerMigration(__DIR__.'/database/migrations');

     }
     public function register(){


     }

}


?>
