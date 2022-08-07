<?php

namespace App\Http\Controllers;

use App\AddNumber;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use App\Http\QueryFilters\UnsolvedQueryFilter;
use App\Http\QueryFilters\CreatedAtOrderQueryFilter;

class ForumIndexController extends Controller
{
    public function __invoke()
    {

        $discussions = app(Pipeline::class)
                    ->send(Discussion::latest())
                    ->through([
                        UnsolvedQueryFilter::class . ':' . request()->get('unsolved'),
                        CreatedAtOrderQueryFilter::class
                    ])
                    ->thenReturn()
                    ->get();

        return view('forum.index', [
            'discussions' => $discussions
        ]);
    }
}
