<?php

namespace app\services;

class HelloServicesIndonesia implements HelloService{
    function hello(string $name): string{
        return "Halo $name";
    }
}