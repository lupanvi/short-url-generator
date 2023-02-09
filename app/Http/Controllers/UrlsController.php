<?php

namespace App\Http\Controllers;

use App\Actions\UrlAction;
use App\Data\UrlData;
use App\Http\Requests\UrlRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use Illuminate\Http\Request;

class UrlsController extends Controller
{    
    public function store(UrlData $data, UrlAction $action)
    {        
        $url = $action->execute($data->short_url); 
        return UrlData::from($url);        
    }    
}
