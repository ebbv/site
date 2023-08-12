<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BulletinController extends Controller
{
    public function index(Request $request, int $year = null, string $month = null)
    {
        $root = 'bulletin';

        $filePath = $root.'/current';

        $url = $root;

        if ($year) {
            $filePath = $root.'/'.$year.'/'.$month;

            $url = $filePath;
        }

        if ($request->has('generate')) {
            return Storage::response($filePath.'.pdf');
        }

        return view('bulletin.index', compact('url'));
    }
}
