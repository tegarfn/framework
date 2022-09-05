<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use app\data\Person;

class ServiceContainerTest extends TestCase
{
    public function TestServiceContainer()
    {

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
}
