<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class envtest extends TestCase
{

    public function testEnv()
    {
        $appName = env("Unmul");
        self::assertEquals("Informatika", $appName);
    }
}
