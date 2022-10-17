<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionTest extends TestCase
{
    public function testCreateSession()
    {
        $this->get('/session/create')
        ->assertSeeText("OK")
        ->assertSessionHas("userId", "tegar")
        ->assertSessionHas("isMember", "true");
    }
    public function testGetSession()
    {
        $this->withSession([
            'userId' => 'tegar',
            'isMember' => 'true'
        ])->get('session/get')
        ->assertSeeText('tegar')
        ->assertSeeText('true');
    }
}
