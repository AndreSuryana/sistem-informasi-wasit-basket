<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadPDF(Request $request, $key = 'document')
    {
        // Check session & file exists
        if (Auth::check() && $request->file($key)) {
            // Get file and define new file info
            $documentPath = $request->file($key);
            $documentName = time() . '.' . $documentPath->getClientOriginalExtension();

            // Store to storage
            $path = $request->file($key)->storeAs('uploads/users/documents', $documentName, 'public');

            // Get absolute path (with APP_URL)
            $absolutePath = env('APP_URL') . 'storage/' . $path;

            return $absolutePath;
        }
    }
}
