<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FascadesTest extends TestCase
{
    public function testConfig()
    {
        $firstName1 = config("tegar");
        $firstName2 = Config::get("tegar");

        self::assertEquals($firstName1, $firstName2);

        var_dump(Config::all());
    }

    public function testConfigDependency()
    {
        $config = $this->app->make("config");
        $firstName1 = $config->get("contoh.author.first");
        $firstName2 = Config::get("contoh.author.first");

        self::assertEquals($firstName1, $firstName2);
    }
    public function testConfigMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn("tegar keren");

        $firstName = Config::get("contoh.author.first");

        self::assertEquals("tegar keren", $firstName);
    }
}
