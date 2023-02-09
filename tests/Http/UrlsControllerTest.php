<?php

namespace Tests\Http;

use App\Http\Controllers\UrlsController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UrlsControllerTest extends TestCase
{
    use RefreshDatabase;   
   
    public function test_short_url_can_be_created()
    {
        $url = 'http://www.google.com.pe';

        $response = $this->post(action([UrlsController::class, 'store']), [
            'url' => $url
        ]);

        $response
            ->assertSuccessful()
            ->assertJson(function (AssertableJson $json) {
                $json                    
                    ->has('short_url')
                    ->etc();
        });

        /*$this->assertDatabaseHas('urls', [
            'original_url' => $url
        ]); */
        
    }     

    public function test_url_is_required()
    {
        $response = $this->post(action([UrlsController::class, 'store']), []);

        $response->assertInvalid(['url']);
    }

    public function test_url_is_valid()
    {
        $response = $this->post(action([UrlsController::class, 'store']), [
            'url' => 'test'
        ]);

        $response->assertInvalid(['url']);
    }
   
}