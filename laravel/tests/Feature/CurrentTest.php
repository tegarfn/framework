<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurrentTest extends TestCase
{
    public function testCurrent()
    {
        $this->get('/url/current?name=Tegar')
        ->assertSeeText("/url/current?name=Tegar");
    }
    public function testNamed()
    {
        $this->get('/url/named')->assertSeeText('redirect/name/Tegar');
    }
    public function testAction()
    {
        $this->get('/url/action')->assertSeeText('/form');
    }
}
