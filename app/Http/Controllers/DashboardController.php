<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\CoachEvent;
use App\Models\Referee;
use App\Models\RefereeEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        // if ($user->role_id <= 2) {
        //     /**
        //      * Return this data when user role
        //      * 
        //      * 1: Registered User
        //      * 2: Wasit/Pelatih
        //      * 
        //      */
        //     $data = [
        //         'user'          => $user,
        //         // TODO : Tampilkan data numberik yg berhubungan dengan user (wasit/pelatih)
        //     ];
        // } else if ($user->role_id > 2) {
        //     /**
        //      * Return this data when user role
        //      * 
        //      * 3: Registered User
        //      * 4: Wasit/Pelatih
        //      * 5: Super Admin (Maybe?) => WARNING! Not Yet Implemented!!!
        //      * 
        //      */
        //     $data = [
        //         'user'          => $user,
        //         'user_count'    => User::count(),
        //         'referee_count' => Referee::where('verified_status', '=', true)->count(),
        //         'coach_count'   => Coach::where('verified_status', '=', true)->count(),
        //         'referee_event_count'   => RefereeEvent::where('verified_status', '=', true)->count(),
        //         'coach_event_count'     => CoachEvent::where('verified_status', '=', true)->count(),
        //     ];
        // }

        $data = [
            'title' => 'Dashboard - SiBasket',
            'user'          => $user,
            'user_count'    => User::count(),
            'referee_count' => Referee::count(),
            'coach_count'   => Coach::count(),
            'referee_event_count'   => RefereeEvent::count(),
            'coach_event_count'     => CoachEvent::count(),
        ];

        return view('dashboard.index', $data);
    }

    public function logout(Request $request)
    {
        // Logout from auth session
        Auth::logout();

        // Clear session token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Return
        return redirect()->route('login');
    }
}
