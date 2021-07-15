<?php
/**
 * This class is used for most common validation
 */
namespace App\Classes;

class Validator {

    /**
     * Check if the uploaded file is a CSV file
     * 
     * @param array $file - The uploaded file
     * @return boolean - true if type is a CSV
     */
    public static function isCSV(array $file) {

        //get php temporal uploaded file path
        $path = $file['tmp_name'];
        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($fileinfo, $path);

        return $file_type == 'text/csv';
    }

    /**
     * 
     */
    public static function CSVIsEmpty(array $file) {

        if(!self::isCSV($file)) return false;
        $path = $file['tmp_name'];

        return filesize($path) === 0;
    }

    /**
     * 
     */
    public static function hasValidMatrix(array $file) {

        if(!self::isCSV($file)) return false;
        
        $filepath = $_FILES['myFile']['tmp_name'];
        $fileSize = filesize($filepath);
    }
}