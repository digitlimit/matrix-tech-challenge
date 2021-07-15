<?php

namespace App\Classes;

class CSV {

    protected array $file;

    public function __construct(array $file) {
        $this->file = $file;
    }

    public function isEmpty() {
        
    }
}