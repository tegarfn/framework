<?php

namespace App\Http\Controllers;

use app\services\HelloService;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\PHP;

class HelloController extends Controller
{
    // public function hello(): string
    // {
    //     return "Hello World";
    // }

    private HelloService $helloService;

    public function __construct(HelloService $helloService)
    {
        $this->helloService = $helloService;
    }
    public function hello(Request $request, string $name): string
    {
        return $this->helloService->hello($name);
    }
    public function request(Request $request): string
    {
        return $request->path() . PHP_EOL .$request->url() . PHP_EOL .$request->fullUrl() . PHP_EOL .$request->method() . PHP_EOL .$request->header('Accept') . PHP_EOL;
    }
}
