<?php

namespace Tests\Feature;

use App\data\Bar;
use app\data\Foo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use app\data\Person;

class ServiceContainerTest extends TestCase
{
    public function TestServiceContainer()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals("Foo", $foo1->foo());
        self::assertEquals("Foo", $foo2->foo());
        self::assertNotEquals($foo1, $foo2);
    }
    public function TestBind()
    {
        $this->app->bind(Person::class, function($app){
            return new Person("Tegar", "Fitrah");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Tegar", $person1->FirstName);
        self::assertEquals("Tegar", $person2->FirstName);
        self::assertNotSame($person1, $person2);

    }

    public function testSingleton(){
        $this->app->singleton(Person::class, function($app){
            return new Person("Tegar", "Fitrah");
        });

        $person1 = $this->app->make(Person::class);//new Person(); if not exists
        $person2 = $this->app->make(Person::class);//return existing

        self::assertEquals("Tegar", $person1->firstName);
        self::assertEquals("Tegar", $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testInstance(){
        $person = new Person("Tegar", "Fitrah");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);//$person
        $person2 = $this->app->make(Person::class);//$person

        self::assertEquals("Tegar", $person1->firstName);
        self::assertEquals("Tegar", $person2->firstName);
        self::assertSame($person1, $person2);
    }
    public function testDependencyInjection1(){
        $this->app->singleton(Foo::class, function ($app){
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertEquals("Foo and Bar", $bar->bar());
        self::assertSame($foo, $bar->foo);
    }
    public function testDependencyInjection2(){
        $this->app->singleton(Foo::class, function ($app){
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app){
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertEquals("Foo and Bar", $bar1->bar());
        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
    }
    public function testHelloService(){
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $helloService = $this->app->make(HelloService::class);
        self::assertEquals("Halo Tegar", $helloService->hello("Tegar"));
    }
}
