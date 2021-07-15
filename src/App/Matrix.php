<?php
namespace App;

/**
 * This class is a reusable helper class for manipulating matrix
 */
class Matrix {

    // array of martix
    protected array $matrix = array();

    // holds the result of operation
    protected $result;

    public function __construct(array $matrix) {
        $this->matrix = $matrix;
    }

    /**
     * echo
     * Return the matrix as a string in matrix format
     * 
     * @return Matrix 
     */
    public function echo() : Matrix {

        $result = '';

        // build a string 
        foreach($this->matrix as $row) {
            $result .= implode(',', $row) . "\r\n";
        }

        $this->result = $result;

        return $this;
    }

    /**
     * invert
     * Return the matrix as a string in matrix format where the 
     * columns and rows are inverted
     * 
     * @return Matrix 
     */
    public function invert() : Matrix {

        $rows = [];
        $result = '';

        // we through each array to build column/rows
        foreach ($this->matrix as $row) {
            foreach ($row as $index => $value) {
                $rows[$index][] = $value;
            }
        }

        // generate a string
        foreach($rows as $row) {
            $result .= implode(',', $row) . "\r\n";
        }

        $this->result = $result;

        return $this;
    }

    /**
     * flatten 
     * Return the matrix as a 1 line string, with values separated by commas.
     * 
     * @return Matrix
     */
    public function flatten(): Matrix {

        // create a recursive interator object
        $arr =  new \RecursiveArrayIterator($this->matrix);
        $interator =  new \RecursiveIteratorIterator($arr);

        // flatten interator object
        $flattened = iterator_to_array($interator, false);
        
        $this->result = implode(',', $flattened ); 

        return $this;
    }

    /**
     * sum
     * Return the sum of the integers in the matrix
     */
    public function sum() : Matrix {

        $this->result = $this->sumMatrix($this->matrix);

        return $this;
    }

    /**
     * multiply
     * Return the product of the integers in the matrix
     */
    public function multiply() : Matrix {

        $this->result = $this->multiplyMatrix($this->matrix);

        return $this;
    }

    /**
     * Magic method that prints string
     * 
     */
    public function __toString() : void {
        header("Content-Type: text/plain");
        echo $this->result;
    }

    /**
     * Sum matrix elements
     * 
     * @param array $data - matrix
     * @param int $sum - initialize value
     * @return int $sum
     */
    protected function sumMatrix($data, $sum = 0) : int {

        foreach($data as $value) {
    
            if( is_array($value) ) {
                // sum sub array
                $sum = $this->sumMatrix($value, $sum);
            }else if(is_int($value)) {
                $sum += $value;
            }
        }
    
        return $sum;
    }

    /**
     * Multiple matrix elements
     * 
     * @param array $data - matrix
     * @param int $sum - initialize value
     * @return int $sum
     */
    protected function multiplyMatrix(array $data, int $sum = 1) : int {

        foreach($data as $value) {
    
            if( is_array($value) ) {
                // sum sub array
                $sum = $this->multiplyMatrix($value, $sum);
            }else if(is_int($value)) {
                $sum *= $value;
            }
        }
    
        return $sum;
    }
}