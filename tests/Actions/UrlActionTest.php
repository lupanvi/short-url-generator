<?php

namespace Tests\Actions;

use App\Actions\UrlAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_generate_short_url()
    {
        $short_url = app(UrlAction::class)->generateShortUrl();
        $this->assertMatchesRegularExpression('/^https?\:\/\/(.*)\/(\w{5})$/i', $short_url);
    }
}
