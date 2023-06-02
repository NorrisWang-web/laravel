<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prefecture;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EventAdminController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prefectures = Prefecture::all();
        return view('admins.events.create', compact('prefectures'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $admin = Auth::User();
        $request->validate([
            'event_datetime' => 'required',
            'event_name' => 'required',
            'prefecture_id' => 'required',
            'max_participants' => 'required',
            'icon' => [
                'required',
                'mimes:jpeg,png,jpg',
            ]
        ]);

        $file_name = $request->files->get('icon')->getClientOriginalName();

        //ファイルをアップロードしている箇所
        $request->icon->storeAs('public/icons/', $file_name);

        $event = new Event();
        $event->create([
            'admin_id' => $admin->id,
            'event_datetime' => $request->event_datetime,
            'event_name' => $request->event_name,
            'prefecture_id' => $request->prefecture_id,
            'max_participants' => $request->max_participants,
            'icon' => $file_name,
        ]);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
