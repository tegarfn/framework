<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectTest extends TestCase
{
    public function testRedirect()
    {
        $this->get('/redirect/from')
        ->assertRedirect('/redirect/to');
    }
    public function testRedirectName()
    {
        $this->get('/redirect/name')
        ->assertRedirect('/redirect/name/Tegar');
    }
    public function testRedirectAction()
    {
        $this->get('/redirect/action')
        ->assertRedirect('/redirect/name/Tegar');
    }
    public function testRedirectAway()
    {
        $this->get('/redirect/pzn')
        ->assertRedirect('https://www.programmerzamannow.com/');
    }
}
