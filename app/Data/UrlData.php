<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class UrlData extends Data
{
    public function __construct(
      #[Required, StringType, Max(255)]
      public string $short_url,
    ) {}
}
