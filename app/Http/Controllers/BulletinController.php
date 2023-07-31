<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BulletinController extends Controller
{
    public $root = 'bulletin';

    public function index(Request $request, int $year = null, string $month = null)
    {
        $action = $request->query('action');

        $filePath = $this->root.'/current';

        $url = $this->root;

        if ($year) {
            $filePath = $this->root.'/'.($year.'/'.$month);

            $url = $filePath;
        }

        if ($action == 'generate') {
            return response()->file(Storage::path($filePath.'.pdf'));
        } elseif ($action == 'download') {
            return Storage::download($filePath.'.pdf');
        }

        return view('bulletin.index', compact('url'));
    }
}
