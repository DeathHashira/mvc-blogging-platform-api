<?php

namespace App\view;

class View
{
    public function __construct(
        public string $template,
        public array $data
    ) {}
}