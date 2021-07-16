<?php declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * BaseTestCase
 */
abstract class TestCase extends BaseTestCase {

    protected string $baseUrl;
    
    protected array $matrix_array = array();

    public function setUp() : void
    {
        $this->matrix_array = [
            [1,2,3],
            [4,5,6],
            [7,8,9]
        ];
    }

    public function tearDown() : void {

    }
}
