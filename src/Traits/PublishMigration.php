<?php
namespace ChatBot\Blueprint\Traits;
use Generator;
use Illuminate\Support\Str;
trait PublishMigration{

    public function registerMigration($directory):void{
         if($this->app->runningInConsole()){
            $geneartor=function(string $directoty):Generator{
                foreach($this->app()->make('files')->allFiles($directory) as $file){
                    yield $file->getPathName()=>$this->app->databasePath('migrations/'.now()->format('y_m_d_His').Str::after($file->getFileName(),'0000_00_00_000000'));
                }
            };
            $this->publishes(iterator_to_array($geneartor($directory)),'migrations');
         }
    }
}



?>
