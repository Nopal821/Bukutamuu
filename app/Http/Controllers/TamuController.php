<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class TamuController extends Controller
{
    public function index()
    {
        $tamus = Tamu::all();
        return view('index', compact('tamus'));
    }

    public function create()
    {
        return view('index');
    }

    public function store(Request $request)
{
    // Validate the incoming request data
    $validator = Validator::make($request->all(), [
        'nama' => 'required|string',
        'alamat' => 'required',
        'no_telp' => 'required|numeric',
        'tujuan_kunjungan' => 'required',
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    try {
        $file = $request->file('foto');

        // Generate a unique filename to avoid overwriting existing files
        $filename = time() . '_' . $file->getClientOriginalName();
        
        // Save the file to the 'public/foto' directory
        $file->storeAs('public/foto', $filename);

        // Automatically set current date and time using Carbon
        $currentDateTime = Carbon::now('Asia/Jakarta');

        // Create Tamu instance with the validated data and file path
        Tamu::create([
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'no_telp' => $request->input('no_telp'),
            'tujuan_kunjungan' => $request->input('tujuan_kunjungan'),
            'foto' => 'foto/' . $filename,
            'tgl_kunjungan' => $currentDateTime->format('Y-m-d'),
            'jam_kunjungan' => $currentDateTime->format('H:i:s'),
        ]);

        // Set a success message in the session
        Session::flash('success', 'Tamu berhasil didaftarkan.');

        // Redirect to the index route
        return redirect()->route('index');

    } catch (\Exception $e) {
        dd('Error message: ' . $e->getMessage());
        // Log the error
        logger()->error('Error inserting data to database: ' . $e->getMessage());

        // Handle the exception, e.g., log the error
        return redirect()->back()->withInput()->with('error', 'Gagal mendaftarkan tamu. Error: ' . $e->getMessage());
    }
}
}