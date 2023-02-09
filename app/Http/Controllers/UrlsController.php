<?php

namespace App\Http\Controllers;

use App\Actions\UrlAction;
use App\Http\Requests\UrlRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use Illuminate\Http\Request;

class UrlsController extends Controller
{
    public function store(UrlRequest $request, UrlAction $action)
    {
        $url = $action->execute($request->getUrl());
        return new UrlResource($url);
    }

    public function redirect(Request $request)
    {
        $redirect = Url::where('short_url', $request->fullUrl())->first();
        return response()->redirectTo($redirect->original_url);
    }
}
