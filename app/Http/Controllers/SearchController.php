<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Search;

class SearchController extends Controller
{
    public function show($search)
    {
      return view('show', ['search' => $search]);
    }
}
