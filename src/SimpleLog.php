<?php

namespace Lenoxzzedwin\SimpleLog;

class  SimpleLog {
    // declare log file and file pointer as private properties
    private $log_file,$fp;


    // set log file (path and name)
    public  function lfile($path,$size = 1) {
        $this->log_file = $path;
    }
    // write message to the log file
    public  function lwrite($message) {
        // if file pointer doesn't exist, then open log file
        if (!is_resource($this->fp)) {
            $this->lopen();
        }


        //if is array
        $message = print_r($message,true);

        // define script name
        $path_log = pathinfo($_SERVER['PHP_SELF']);
        $script_name = $path_log['dirname'];
        if($path_log['dirname'] != "\\"){
            $script_name .= "/";
        }
        $script_name .= $path_log['basename'];

        // define current time and suppress E_WARNING if using the system TZ settings
        // (don't forget to set the INI setting date.timezone)
        $time = @date('[D M d G:i:s Y]');
        // write current time, script name and message to the log file
        fwrite($this->fp, "$time ($script_name) $message" . PHP_EOL);

        // if exists warning
        if(!is_null(error_get_last())){
            $erro = error_get_last(); 
            $message_erro = 'Warning: '.$erro['message'].' in '.$erro['file'].' on line '.$erro['line'];
            fwrite($this->fp, "$time ($script_name) $message_erro" . PHP_EOL);
        }
    }
    // close log file (it's always a good idea to close a file when you're done with it)
    public function lclose() {
        fclose($this->fp);
    }
    // open log file (private method)
    private function lopen() {
        // in case of Windows set default log file
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $log_file_default = 'c:/php/logfile.txt';
        }
        // set default log file for Linux and other systems
        else {
            $log_file_default = '/tmp/logfile.txt';
        }
        // define log file from lfile method or use previously set default
        $lfile = $this->log_file ? $this->log_file : $log_file_default;
        // open log file for writing only and place file pointer at the end of the file
        // (if the file does not exist, try to create it)
        $this->fp = fopen($lfile, 'a') or exit("Can't open $lfile!");
    }
}