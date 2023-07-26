<?php

namespace App\Http\Controllers;

class BulletinController extends Controller
{
    public function index ($year = null, $month = null)
    {
        $fileName = 'current';

        if ($year) {
            $fileName = $year.'/'.$month;
        }

        return view('bulletin.index', compact('fileName'));
    }
}
