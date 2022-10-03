<?php

namespace app\data;

class Person
{
    public function __construct(
        public string $firstName, 
        public string $lastName)
    {
        
    }
}