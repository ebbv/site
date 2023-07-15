<?php

namespace App\Http\Controllers;

class BulletinController extends Controller
{
    public function index (int $year = null, string $month = null)
    {
        $fileName = 'current';

        if ($year) {
            $fileName = $year.'/'.$month;
        }

        return response()->file('storage/bulletin/'.$fileName.'.pdf');
    }
}
