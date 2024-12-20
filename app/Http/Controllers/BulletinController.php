<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BulletinController extends Controller
{
    public function index(Request $request, int $year = null, string $month = null)
    {
        $now = \Carbon\Carbon::now();

        $filePath = 'bulletin/'.($year ?? $now->year).'/'.($month ?? strtr($now->monthName, ['é' => 'e', 'û' => 'u']));

        if ($request->has('generate')) {
            return Storage::response($filePath.'.jpg');
        }

        return view('bulletin.index', ['url' => $filePath]);
    }
}
