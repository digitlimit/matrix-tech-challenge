<?php

namespace League\App;

/**
 * This class is a helper class for interacting with a CSV file
 */
class CSV {

    protected array $matrix = array();

    // a csv file
    protected array $file;

    // the width of matrix
    protected int $width = 0;

    // the height of matrix
    protected int $heigth = 0;

    protected bool $is_matrix = true;

    public function __construct(array $file) { 
        $this->file = $file;
        $this->init($file);
    }

    // initialize variables
    protected function init(array $file) : void {

        $rows = array_map('str_getcsv', 
            file($file['tmp_name'])
        );

        // check if csv is empty
        if(!count($rows)){
            $this->is_matrix = false;
            return;
        }

        $counter = 0;

        foreach( $rows as $row )
        {
            $counter++;
            $this->heigth++;

            // $row is an array of the csv elements
            //should not be an empty row
            if( !count($row) ) {
                $this->is_matrix = false;
                break;
            }

            // keep track of width and compare row widths
            // if there is any change in row width then its 
            // flagged as invalid matrix
            if( $counter === 1 ){
                $this->width = count($row);
            }elseif( $this->width != count($row) ) {
                $this->is_matrix = false;
                break;
            }
             
            $this->matrix[] = $row;
        }

        // matrix should have equal dimensions
        if ($this->heigth != $this->width) {
            $this->is_matrix = false;
        }
    }

    /**
     * isValidMatrix
     * Assert the CSV is valid and contains valid elements
     */
    public function isValidMatrix() : bool {
        return $this->is_matrix;
    }

    /**
     * getMatrix
     * 
     * Return an array of matrix
     */
    public function getMatrix() : array {
        return $this->matrix;
    }
}