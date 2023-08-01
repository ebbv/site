<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BulletinController extends Controller
{
    public $root = 'bulletin';

    public function index(Request $request, int $year = null, string $month = null)
    {
        $filePath = $this->root.'/current';

        $url = $this->root;

        if ($year) {
            $filePath = $this->root.'/'.($year.'/'.$month);

            $url = $filePath;
        }

        if ($request->has('generate')) {
            return Storage::response($filePath.'.pdf');
        }

        return view('bulletin.index', compact('url'));
    }
}
