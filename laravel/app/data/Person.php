<?php

namespace app\data;

class Person
{
    public function __construct(
        public string $FirstName, 
        public string $LastName)
    {
        
    }
}