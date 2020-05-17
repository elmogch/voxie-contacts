<?php

namespace App\Src;

class CsvReader {
    public $csv_file_path;
    public $delimiter;

    public function __construct($csv_file_path, $delimiter=','){
        $this->csv_file_path = $csv_file_path;
        $this->delimiter = $delimiter;
    }

    function toArray() {
        if(!file_exists($this->csv_file_path) || !is_readable($this->csv_file_path))
            return FALSE;
        
        $header = NULL;
        $data = array();
        if (($handle = fopen($this->csv_file_path, 'r')) !== FALSE) {
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