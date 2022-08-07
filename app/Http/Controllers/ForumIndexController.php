<?php

namespace App\Http\Controllers;

use App\AddNumber;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class ForumIndexController extends Controller
{
    public function __invoke()
    {
        // $number = app(Pipeline::class)
        //         ->send(5)
        //         ->through([
        //             function($number, $next) {
        //                 $number = $number + 1;
        //                 return $next($number);
        //             },
        //             function($number, $next) {
        //                 $number = $number * 2;
        //                 return $next($number);
        //             }
        //         ])
        //         ->thenReturn();

        $number = app(Pipeline::class)
                ->send(5)
                ->through([
                   AddNumber::class
                ])
                ->thenReturn();

        dd($number);
    }
}
