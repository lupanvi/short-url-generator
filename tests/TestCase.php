<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createRequest($method, $uri): Request
    {
        $symfonyRequest = SymfonyRequest::create(
            $uri,
            $method,
        );

        return Request::createFromBase($symfonyRequest);
    }
}
