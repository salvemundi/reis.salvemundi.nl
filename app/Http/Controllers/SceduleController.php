<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scedule;

class SceduleController extends Controller
{
    public function index()
    {
        $name = 'bierpong';
        $description = 'balletjes in bekertjes gooien';
        $beginTime = '18:00';
        $endTime = '21:00';
        return view('qr-code', ['name' => $name, 'description' => $description, 'beginTime' => $beginTime, 'endTime' => $endTime]);
    }
}
