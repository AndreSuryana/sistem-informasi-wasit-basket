<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'user'          => Auth::user(),
            'title'         => 'Profil - SiBasket',
            'navbar_title'  => 'Profil',
            'cities'        => City::all(),
        ];

        // dd($data);

        return view('profile.index', $data);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Get current user id
        $userId = Auth::user()->id;

        // Get request data
        $userData = [
            'first_name'        => $request->input('first_name'),
            'last_name'         => $request->input('last_name'),
            'full_name'         => $request->input('full_name'),
            'email'             => $request->input('email'),
            'gender'            => $request->input('gender'),
            'place_of_birth'    => $request->input('place_of_birth'),
            'date_of_birth'     => $request->input('date_of_birth'),
            'phone'             => $request->input('phone'),
            'address'           => $request->input('address'),
            'city_id'           => $request->input('city_id'),
            'other_profession'  => $request->input('other_profession'),
        ];

        // Carbon::createFromFormat('d/m/Y', $request->input('date_of_birth')),

        // Store photo
            // Create validator
            // $validator = Validator::make($request->all(), $rules);

            // if ($validator->fails()) {
            //     return response()->json([
            //         'error' => 'Foto harus berformat png/jpg/jpeg!',
            //     ], 400);
            // }

        // Save photo and get path
        // $photoPath = $request->file('photo');
        // $photoName = $photoPath->getClientOriginalName();

        // $path = $request->file('photo')->storeAs('uploads', $photoName, 'public');

        // $userData += ['photo_path' => $path];
        // } else {
        //     // Update avatar url (from API)
        //     if (!empty($userData['first_name']) && empty($user['last_name'])) {
        //         $userData += [
        //             'photo_path' => 'https://ui-avatars.com/api/?format=svg&name=' . $userData['first_name'] . "+" . $userData['last_name']
        //         ];
        //     }
        // }

        // Update user
        $updated = User::find($userId)
            ->update($userData);

        if ($updated) {
            return response()->json([
                'success' => 'Data diri Anda berhasil diubah!',
            ], 200);
        } else {
            return response()->json([
                'error' => 'Data diri Anda gagal diubah!'
            ], 400);
        }
    }

    public function uploadPhoto(Request $request) {
        // Make sure user still login in session
        if (Auth::check() && $request->file('photo')) {
            // Get file and define new file info
            $imagePath = $request->file('photo');
            $imageName = time() . '.' . $imagePath->getClientOriginalExtension();

            // Store to storage
            $path = $request->file('photo')->storeAs('uploads/users/images', $imageName, 'public');

            // Get current user
            $userId = Auth::id();
            $user = User::find($userId);

            // Update user photo path
            $user->photo_path = env('APP_URL') . 'storage/' . $path;

            if ($user->save()) {
                return redirect()->route('profile.index')
                    ->with('photo-success', 'Foto profil berhasil diubah.');
            } else {
                return redirect()->route('profile.index')
                    ->with('photo-error', 'Foto profil gagal diubah!');
            }
        }

        // Handle error
        return redirect()->route('profile.index')
            ->with('photo-error', 'Terjadi kesalahan pada server!');
    }
}
