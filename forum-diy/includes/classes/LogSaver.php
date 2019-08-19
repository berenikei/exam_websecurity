<?php

/*
 * This class is used to save logs anywhere we need to
 */

class LogSaver
{
    public static function save_the_log($whatToSave, $whereToSave){
        date_default_timezone_set("Europe/Copenhagen");
        $error_log = '{"DATE":'.date("Y-m-d").', "TIME": '.date("h:i:sa").' , "Error": '.$whatToSave.', "line": '.__LINE__.'}';
        file_put_contents('./includes/logs/'.$whereToSave, $error_log , FILE_APPEND );
    }
}