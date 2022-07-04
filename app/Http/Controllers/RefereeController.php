<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Game;
use App\Models\Level;
use App\Models\Referee;
use App\Models\RefereeEvent;
use App\Models\RefereeLicence;
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

    public function showFormEvent()
    {
        $data = [
            'title'         => 'Data Event Wasit - SiBasket',
            'navbar_title'  => 'Data Event Wasit',
            'user'          => Auth::user(),
            'events'        => Auth::user()->referee->events,
        ];

        return view('referee.event.index', $data);
    }

    public function storeEvent(Request $request)
    {
        // Get current referee
        $refereeId = Auth::user()->referee->id;
        
        // Return error if referee not exists
        if ($refereeId == null) {
            return response()->json([
                'error' => 'Anda tidak/belum terverifikasi menjadi wasit!'
            ], 400);
        }

        // Get request data
        $eventData = [
            'referee_id'    => $refereeId,
            'level_id'      => $request->input('level_id'),
            'city_id'       => $request->input('city_id'),
            'name'          => $request->input('name'),
            'start_date'    => $request->input('start_date'),
            'end_date'      => $request->input('end_date'),
            'position'      => $request->input('position'),
            'document_path' => $this->uploadPDF($request, 'document'),
        ];

        // Store referee event data
        $stored = RefereeEvent::create($eventData);

        if ($stored) {
            return response()->json([
                'success' => 'Data event wasit berhasil ditambah!'
            ], 200);
        } else {
            return response()->json([
                'error' => 'Data event wasit gagal ditambah!'
            ], 400);
        }
    }

    public function updateEvent(Request $request, $id)
    {
        // Get request data
        $eventData = [
            'level_id'      => $request->input('level_id'),
            'city_id'       => $request->input('city_id'),
            'name'          => $request->input('name'),
            'start_date'    => $request->input('start_date'),
            'end_date'      => $request->input('end_date'),
            'position'      => $request->input('position'),
            'document_path' => $this->uploadPDF($request, 'document'),
        ];

        // Store referee event data
        $updated = RefereeEvent::findOrFail($id)
            ->update($eventData);

        if ($updated) {
            return response()->json([
                'success' => 'Data event wasit berhasil diubah!'
            ], 200);
        } else {
            return response()->json([
                'error' => 'Data event wasit gagal diubah!'
            ], 400);
        }
    }

    public function deleteEvent($id)
    {
        // Delete event by id
        $deleted = RefereeEvent::findOrFail($id)->delete();

        if ($deleted) {
            return response()->json([
                'success' => 'Data event berhasil dihapus!',
            ], 200);
        } else {
            return response()->json([
                'error' => 'Data event gagal dihapus!'
            ], 400);
        }
    }

    public function storeGame(Request $request, $eventId)
    {
        // Get request data
        $gameData = [
            'referee_event_id'  => $eventId,
            'team_a'            => $request->input('team_a'),
            'team_b'            => $request->input('team_b'),
            'description'       => $request->input('description')
        ];

        // Store game data
        $stored = Game::create($gameData);

        if ($stored) {
            return response()->json([
                'success' => 'Data game wasit berhasil ditambah!'
            ], 200);
        } else {
            return response()->json([
                'error' => 'Data game wasit gagal ditambah!'
            ], 400);
        }
    }

    public function updateGame(Request $request, $id)
    {
        // Get request data
        $gameData = [
            'team_a'            => $request->input('team_a'),
            'team_b'            => $request->input('team_b'),
            'description'       => $request->input('description')
        ];

        // Store game data
        $updated = Game::firstOrFail($id)
            ->update($gameData);

        if ($updated) {
            return response()->json([
                'success' => 'Data game wasit berhasil ditambah!'
            ], 200);
        } else {
            return response()->json([
                'error' => 'Data game wasit gagal ditambah!'
            ], 400);
        }
    }

    public function deleteGame($id)
    {
        // Delete event games by id
        $deleted = Game::findOrFail($id)->delete();

        if ($deleted) {
            return response()->json([
                'success' => 'Data game berhasil dihapus!',
            ], 200);
        } else {
            return response()->json([
                'error' => 'Data game gagal dihapus!'
            ], 400);
        }
    }

    public function showFormLicence()
    {
        $data = [
            'title'         => 'Data Lisensi Wasit - SiBasket',
            'navbar_title'  => 'Data Lisensi Wasit',
            'user'          => Auth::user(),
            'licences'      => Auth::user()->referee->licences,
        ];

        return view('referee.license.index', $data);
    }

    public function storeLicence(Request $request)
    {
        // Get current referee
        $refereeId = Auth::user()->referee->id;
        
        // Return error if referee not exists
        if ($refereeId == null) {
            return response()->json([
                'error' => 'Anda tidak/belum terverifikasi menjadi wasit!'
            ], 400);
        }

        // Get request data
        $licenceData = [
            'referee_id'    => $refereeId,
            'game_type'     => $request->input('game_type'),
            'licence_level' => $request->input('licence_level'),
            'start_date'    => $request->input('start_date'),
            'end_date'      => $request->input('end_date'),
            'document_path' => $this->uploadPDF($request, 'document'),
        ];

        // Store referee license data
        $stored = RefereeLicence::create($licenceData);

        if ($stored) {
            return response()->json([
                'success' => 'Data license wasit berhasil ditambah!'
            ], 200);
        } else {
            return response()->json([
                'error' => 'Data license wasit gagal ditambah!'
            ], 400);
        }
    }

    public function updateLicence(Request $request, $id)
    {
        // Get request data
        $licenceData = [
            'game_type'     => $request->input('game_type'),
            'licence_level' => $request->input('licence_level'),
            'start_date'    => $request->input('start_date'),
            'end_date'      => $request->input('end_date'),
            'document_path' => $this->uploadPDF($request, 'document'),
        ];

        // Store referee license data
        $updated = RefereeLicence::findOrFail($id)
            ->update($licenceData);

        if ($updated) {
            return response()->json([
                'success' => 'Data license wasit berhasil diubah!'
            ], 200);
        } else {
            return response()->json([
                'error' => 'Data license wasit gagal diubah!'
            ], 400);
        }
    }

    public function deleteLicence($id)
    {
        // Delete license by id
        $deleted = RefereeLicence::findOrFail($id)->delete();

        if ($deleted) {
            return response()->json([
                'success' => 'Data lisensi berhasil dihapus!',
            ], 200);
        } else {
            return response()->json([
                'error' => 'Data lisensi gagal dihapus!'
            ], 400);
        }
    }
}
