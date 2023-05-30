<?php
namespace ChatBot\Blueprint\Traits;
use Generator;
use Illuminate\Support\Str;
trait PublishMigration{

    public function registerMigration($directory):void{
         if($this->app->runningInConsole()){
            $geneartor=function(string $directoty):Generator{
                foreach($this->app->make('files')->allFiles($directory) as $file){
                    $file_name='_'.$file->getFileName();
                    $mod_file=preg_replace('/_[0-9]+/','',$file_name);
                    yield $file->getPathName()=>$this->app->databasePath('migrations/'.now()->format('y_m_d_His').$mod_file);
                }
            };
            $this->publishes(iterator_to_array($geneartor($directory)),'migrations');
         }
    }
}



?>
