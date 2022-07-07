<?php

namespace App\Http\Controllers\Api;

use App\Models\Stay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StayRequest;

use App\Http\Resources\StayResource;




class StayApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StayResource::collection(Stay::orderBy('created_at', 'desc')->paginate(10));
    }

    public function getTypes() {
        $types['hotels'] = Stay::where('type', 'hotel')->count();
        $types['apartments'] = Stay::where('type', 'apartment')->count();
        $types['resorts'] = Stay::where('type', 'resort')->count();
        $types['villas'] = Stay::where('type', 'villa')->count();
        $types['cottages'] = Stay::where('type', 'cottage')->count();
        return $types;
    }


}
