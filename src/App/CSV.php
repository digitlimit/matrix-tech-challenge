<?php
namespace App;

/**
 * This class is a helper class for interacting with a CSV file
 */
class CSV {

    protected array $matrix = array();

    protected array $file;

    protected int $width = 0;

    protected int $heigth = 0;

    protected bool $is_matrix = true;

    public function __construct(array $file) {
        $this->file = $file;
        $this->init();
    }

    protected function init() : void {
        
        $file = fopen($this->file['tem_name'], 'r');

        $counter = 0;

        while (($row = fgetcsv($file)) !== FALSE) {

            $counter++;
            $this->heigth++;

            // $row is an array of the csv elements
            //should not be an empty row
            if( !count($row) ) {
                $this->is_matrix = false;
                break;
            }

            // keep track of width and compare row widths
            // if there is any change in row width then its flagged as invalid
            // matrix
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

    public function isValidMatrix() : bool {
        return $this->is_matrix;
    }

    public function getMatrix() : array {
        return $this->matrix;
    }
}