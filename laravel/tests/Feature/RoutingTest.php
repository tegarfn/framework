<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testBasicRouting()
    {
        $this->get("/iu")
            ->assertStatus(200)
            ->assertSeeText("Halo Informatika Unmul");
    }

    public function testRedirect()
    {
        $this->get("/youtube")
            ->assertRedirect("/iu");
    }

    public function testFallback()
    {
        $this->get("/404")
            ->assertSeeText("404");
    }

    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText("Hello Tegar");

        $this->get('/hello-again')
            ->assertSeeText("Hello Tegar");
    }

    public function testViewNested()
    {
        $this->get('/hello-world')->assertSeeText("World Tegar");
    }

    public function testViewWithoutRoute()
    {
        $this->view('hello', ['name' => 'Tegar'])->assertSeeText('Hello Tegar');
    }

    public function testRouteParameter()
    {
        $this->get('products/1')->assertSeeText("Products : 1");
        $this->get('products/1/items/xxx')->assertSeeText("Products : 1, Items : xxx");

    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/12345')->assertSeeText("Categories : 12345");
        $this->get('/categories/salah')->assertSeeText("404");
    }

    public function testRoutingConflict()
    {
        $this->get('/conflict/gial')->assertSeeText("Conflict gial");
        $this->get('/conflict/tegar')->assertSeeText("Conflict tegar");
    }

    public function testNamed()
    {
        $this->get('/produk/12345')->assertSeeText('products/12345');
        $this->get('/produk-redirect/12345')->assertSeeText('products/12345');
    }

    public function testInput()
    {
        $this->get('/input/hello?name=Tegar')->assertSeeText("Hello Tegar");
        $this->post('/input/hello', ['name' => 'Tegar'])->assertSeeText("Hello Tegar");
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first', ['name' => ['first' => 'Tegar']])->assertSeeText('Hello Tegar');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', ['name' => ['first' => 'Tegar', 'last' => 'Fitrah']])->assertSeeText("name")->assertSeeText("first")->assertSeeText("Tegar")->assertSeeText("last")->assertSeeText("Fitrah");
    }
    public function testArrayInput()
    {
        $this->post('/input/hello/input', [
            'prooducts' => [
                ['name' => 'Apple Mac Book Pro'],
                ['nme' => 'Samsung Galaxy S']
            ]
        ])->assertSeeText("Apple Mac Book Pro")->assertSeeText("Samsung Galaxy S");
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Tegar',
            'married' => 'true',
            'birth_date' => '2001-12-21',
        ])->assertSeeText('Tegar')->assertSeeText('true')->assertSeeText('2001-12-21');
    }
    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                'first' => 'Tegar',
                'middle' => 'Fitrah',
                'last' => 'Atthoriq'
            ]
        ])->assertSeeText('Tegar')->assertDontSeeText('Fitrah')->assertSeeText('Atthoriq');
    }
    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            'username' => 'Tegar',
            'admin' => 'true',
            'password' => 'rahasia'
        ])->assertSeeText('Tegar')->assertDontSeeText('admin')->assertSeeText('rahasia');
    }

    public function testFilterMerge()
    {
        $this->post('input/filter/merge', [
            "username" => "Tegar",
            "admin" => "true",
            "password" => "rahasia"

        ])->assertSeeText('Tegar')->assertSeeText('rahasia')->assertSeeText('admin')->assertSeeText('false');
    }
}
