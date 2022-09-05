<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use app\data\Foo;
use app\data\Bar;

class depedency extends TestCase
{
    public function depedency(){
        $foo = new foo();
        $bar = new bar($foo);

        self::assertEquals("Foo and Bar", $bar->bar());
    }
}
