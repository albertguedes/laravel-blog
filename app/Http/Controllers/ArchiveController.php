<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request): View
    {
        $year = (int) $request->get('year', 0);
        $month = (int) $request->get('month', 0);
        $day = (int) $request->get('day', 0);

        return view('archive', compact('year','month','day'));
    }
}
