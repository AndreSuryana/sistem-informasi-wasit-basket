<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Level;
use App\Models\Referee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefereeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');   
    }

    /**
     * Show form for editing the specified referee.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'user'          => Auth::user(),
            'title'         => 'Data Wasit - SiBasket',
            'navbar_title'  => 'Data Wasit',
            'cities'        => City::all(),
            'levels'        => Level::all()
        ];

        return view('referee.index', $data);
    }

    /**
     * Update the specified referee in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Get current user id
        $userId = Auth::id();

        // Check if user already has referee data
        $referee = Referee::where('user_id', '=', $userId)->firstOrFail();

        // Check document upload
        $document = $request->file('document');
        if ($document) {
            
            $documentPath = $document;
            $documentName = time() . '.' . $documentPath->getClientOriginalExtension();

            // Store to storage
            $path = $document->storeAs('uploads/referees/document', $documentName, 'public');

            // Complete path
            $completePath = env('APP_URL') . 'storage/' . $path;
        }

        if ($referee) {
            // Update existsed referee data
            $referee->update([
                'level_id'  => $request->input('level_id'),
                'city_id'   => $request->input('city_id'),
                'document_path'  => $completePath
            ]);
        } else {
            // Create new referee data
            Referee::create([
                'user_id'   => $userId,
                'level_id'  => $request->input('level_id'),
                'city_id'   => $request->input('city_id'),
                'document_path'  => $completePath
            ]);
        }
    }
}
