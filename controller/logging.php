<?php
require_once '../controller/user.php';

class LogController 
{
    private $ip;

    public function log($message)
    {
        $ip =  $_SERVER['REMOTE_ADDR']; 

        $user = unserialize($_SESSION['userObj']);
        $userId = $user->id;

        $logs = __DIR__ . "/../logs/";
        $file=fopen($logs.date("Y-m-d")."-User id".$_SESSION['userId'].'.log', 'a');
        fwrite($file,$message."| IP:" . $ip ."\n");
    }

    
}
?>