<?php

namespace App\Listeners;
use App\Model\Video;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\VideoViewer;

class IncreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        $this -> updatViewr($event -> video);
    }
    public function updatViewr($video){

        $video ->viewer =  $video ->viewer +1 ;
        $video ->save();
         
    }
}
