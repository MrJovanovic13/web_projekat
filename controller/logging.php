<?php

class LogController 
{
    public function log($message)
    {
        $ip =  $_SERVER['REMOTE_ADDR']; 

        $user = unserialize($_SESSION['userObj']);
        
        $logs = __DIR__ . "/../logs/";
        $file=fopen($logs.date("Y-m-d")."-User id".$user->id.'.log', 'a');
        fwrite($file,'UserID: '.$user->id.' | name: '.$user->name. ' | '.$message.' | '.date("h:i:sa") . ' IP: '. $ip ."\n");
    }

    
}
?>