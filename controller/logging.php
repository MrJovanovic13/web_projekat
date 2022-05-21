<?php
require_once '../controller/user.php';

class LogController 
{
    public function log($message)
    {
        $user = unserialize($_SESSION['userObj']);
        $userId = $user->id;

        $logs = __DIR__ . "/../logs/";
        $file=fopen($logs.date("Y-m-d").'-'.$userId, 'a');
        fwrite($file,$user->name.' : test'."\n");
    }
}

?>