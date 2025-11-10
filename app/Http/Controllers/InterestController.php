<?php

namespace App\Http\Controllers;

use App\Models\Interest;

class InterestController extends Controller {
    public function index() {
        $interests = Interest::all();
        return response()->json($interests);
    }
}
