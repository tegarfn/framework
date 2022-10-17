<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class ResponseTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')->assertStatus(200)->assertSeeText("Hello Response");
    }
    public function testHeader()
    {
        $this->get('/response/header')
        ->assertStatus(200)
        ->assertSeeText("Tegar")->assertSeeText("Fitrah")
        ->assertHeader('Content-Type', 'application/json')
        ->assertHeader('Author', 'Tegar Fitrah')
        ->assertHeader('App', 'Laravel Dasar');
    }

    public function testView()
    {
        $this->get('/response/type/view')
        ->assertSeeText("Hello Tegar");
    }
    public function testJson()
    {
        $this->get('/response/type/json')
        ->assertJson(['firstName' => "Tegar", 'lastName' => "Fitrah"]);
    }
    public function testFile()
    {
        $this->get('/response/type/file')
        ->assertHeader('Content-Type', 'image/png');
    }
    public function testDownload()
    {
        $this->get('/response/type/download')
        ->assertDownload('tegar.png');
    }

    public function testEncrypt()
    {
        $encrypt = Crypt::encrypt('Tegar Fitrah');
        $decrypt = Crypt::decrypt($encrypt);

        self::assertEquals('Tegar Fitrah', $decrypt);
    }
}
