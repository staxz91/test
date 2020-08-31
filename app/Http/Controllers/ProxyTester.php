<?php

namespace App\Http\Controllers;

use App\Http\Services\ProxyService;
use Illuminate\Http\Request;

class ProxyTester extends Controller
{

    private $proxyService;

    public function __construct()
    {

        $this->proxyService = new ProxyService();
    }

    public function index()
    {
        return view('proxy-test');
    }

    public function checkProxy(Request $request){
        return $this->proxyService->test($request);
    }

}
