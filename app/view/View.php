<?php

namespace App\view;
/**
 * Default format for content sending through response to server
 */
class View
{
    public function __construct(
        public string $template,
        public array $data
    ) {}
}