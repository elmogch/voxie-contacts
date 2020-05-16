<?php

namespace App\Src;

class CsvReader {
    public $csvFile;
    public $delimiter;

    public function __construct($csvFile, $delimiter=','){
        $this->csvFile = $csvFile;
        $this->delimiter = $delimiter;
    }

    function toArray() {
        if(!file_exists($this->csvFile) || !is_readable($this->csvFile))
            return FALSE;
        
        $header = NULL;
        $data = array();
        if (($handle = fopen($this->csvFile, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 0, $this->delimiter)) !== FALSE) {
                if(!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        return $data;
    }
}