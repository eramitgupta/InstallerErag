<?php

namespace InstallerErag\Main;

class InstalledManager
{
     /**
      * Create installed file.
      *
      * @return int
      */
     public static function create()
     {
          $installedLogFile = storage_path('installed');
          $dateStamp = date('Y/m/d h:i:sa');
          $message = 'successfully installed';
          file_put_contents($installedLogFile, $message.' '.$dateStamp . PHP_EOL, FILE_APPEND | LOCK_EX);
          return $message;
     }
}
