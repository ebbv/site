<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BulletinController extends Controller
{
    public function index(Request $request, int|null $year = null, string|null $month = null)
    {
        $now = Carbon::now()->startOfMonth();

        $selectedDate = Carbon::parseFromLocale(($year ?? $now->year).' '.($month ?? $now->monthName));

        $filePath = 'bulletin/'.$selectedDate->year.'/'.strtr($selectedDate->monthName, ['é' => 'e', 'û' => 'u']);

        if (Storage::missing($filePath.'.jpg')) {
            if ($selectedDate->eq($now)) {
                $now->subMonth();
            }

            return redirect('bulletin/'.$now->year.'/'.$now->monthName);
        }

        if ($request->has('generate')) {
            return Storage::response($filePath.'.jpg');
        }

        return view('bulletin.index', ['url' => $filePath, 'now' => $now]);
    }
}
