<?php

namespace Tests\Unit;

use Tests\TestCase;
use League\App\Matrix;

/**
 * Test matrix methods
 */
class MatrixTest extends TestCase
{
    /**
     * Test echo method
     * 
     * @test
     * @group unit
     * @group unit_matrix_echo
     * @return void
     */
    public function feature_matrix_echo() : void
    {
        //assert expected output is returned
       $matrix = new Matrix($this->matrix_array);
       $this->assertEquals($matrix->echo()->getResult(), 
        "1,2,3\r\n".
        "4,5,6\r\n".
        "7,8,9\r\n");
    }

    /**
     * Test invert method
     * 
     * @test
     * @group unit
     * @group unit_matrix_echo
     * @return void
     */
    public function feature_matrix_invert() : void
    {
        //assert expected output is returned
        $matrix = new Matrix($this->matrix_array);
        $this->assertEquals($matrix->invert()->getResult(), 
         "1,4,7\r\n".
         "2,5,8\r\n".
         "3,6,9\r\n");
    }

     /**
     * Test flatten method
     * 
     * @test
     * @group unit
     * @group unit_matrix_flatten
     * @return void
     */
    public function feature_matrix_flatten() : void
    {
        //assert expected output is returned
        $matrix = new Matrix($this->matrix_array);
        $this->assertEquals(
            $matrix->flatten()->getResult(), 
            "1,2,3,4,5,6,7,8,9"
        );
    }

    /**
     * Test sum method
     * 
     * @test
     * @group unit
     * @group unit_matrix_sum
     * @return void
     */
    public function feature_matrix_sum() : void
    {
        //assert expected output is returned
        $matrix = new Matrix($this->matrix_array);
        $this->assertEquals($matrix->sum()->getResult(),  45);
    }

    /**
     * Test multiply method
     * 
     * @test
     * @group unit
     * @group unit_matrix_multiply
     * @return void
     */
    public function feature_matrix_multiply() : void
    {
        //assert expected output is returned
        $matrix = new Matrix($this->matrix_array);
        $this->assertEquals($matrix->multiply()->getResult(),  362880);
    }
}