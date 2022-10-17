<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertJson;

class CookieTest extends TestCase
{
    public function testCreateCookie()
    {
        $this->get('/cookie/set')
        ->assertCookie('User-Id', 'tegar')
        ->assertCookie('Is-Member', 'true');
    }
    public function testGetCookie()
    {
        $this->withCookie('User-Id', 'tegar')
        ->withCookie('Is-Member', 'true')
        ->get('/cookie/get')
        ->assertJson([
            'userId' => 'tegar',
            'isMember' => 'true'
        ]);
    }
}
