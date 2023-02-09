<?php

namespace App\Actions;

use App\Models\Url;
use Illuminate\Support\Str;

class UrlAction
{

    public function execute(string $url): Url{

        return Url::create([
            'original_url' => $url,
            'short_url' => $this->generateShortUrl()
        ]);

    }

    public function generateShortUrl()
    {
        return url('') . '/' . Str::random(5);
    }       

}