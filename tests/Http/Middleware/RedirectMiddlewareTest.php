<?php

namespace Tests\Http\Middleware;

use App\Http\Middleware\RedirectMiddleware;
use App\Models\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;

class RedirectMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_middleware_in_isolation()
    {
        $middleware = app(RedirectMiddleware::class);

        $response = $middleware->handle(
            $this->createRequest('get', '/'),
            fn () => new Response()
        );

        $this->assertTrue($response->isSuccessful());

        $url = Url::factory()->create();

        $response = $middleware->handle(
            $this->createRequest('get', $url->short_url),
            fn () => new Response()
        );


        $this->assertTrue($response->isRedirect($url->original_url));
    }

    public function test_middleware_as_integration()
    {
        
        $url = Url::factory()->create();

        $response = $this->get($url->short_url);

        $response->assertRedirect($url->original_url);
    }
}
