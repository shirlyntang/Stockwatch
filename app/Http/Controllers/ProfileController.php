<?php

namespace App\Http\Controllers;

use App\Models\Houseguest;
use App\Models\Season;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $user->load([
            'banks',
            'transactions',
            'leaderboard',
            'stocks' => function ($query) {
                $query->where('quantity', '>', 0);
            }
        ]);

        $season = Season::current();
        $bank = $user->bank;
        $houseguests = Houseguest::with('prices')
                                 ->where('season_id', $season->id)
                                 ->withoutGlobalScope('active')
                                 ->get();

        return view('profile', compact('user', 'bank', 'houseguests', 'season'));
    }
}
