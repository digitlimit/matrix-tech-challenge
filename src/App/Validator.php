<?php

namespace League\App;

/**
 * This class is used for most common validation
 */
class Validator {

    /**
     * Check if the uploaded file is a CSV file
     * 
     * @param array $file - The uploaded file
     * @return boolean - true if type is a CSV
     */
    public static function isCSV(array $file) {

        $filename = $file['name'];
        $file_info = pathinfo($filename);

        // check extension
        if($file_info['extension'] != 'csv'){
            return false;
        }

        // allowed mimes
        $allowed_mimes = [
            'text/plain',
            'text/csv',
            'application/octet-stream'
        ];
        
        //check mime type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        // check if mime type is allowed
        // curl tends to send text/plain mime type
        // while browser sends text/csv mime type
        if(!in_array($mime, $allowed_mimes) 
            && !in_array($file['type'], $allowed_mimes)) {
            return false;
        }

        return count(array_map('str_getcsv', file($file['tmp_name'])));
    }

    /**
     * CSVISEmpty
     * Check if csv is empty
     */
    public static function CSVIsEmpty(array $file) {

        if(!self::isCSV($file)) return false;
        $path = $file['tmp_name'];

        return filesize($path) === 0;
    }
}