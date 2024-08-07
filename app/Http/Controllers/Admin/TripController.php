<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Day;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::Id();
        $trips = Trip::where('id_user', $user)->get();
        return view ('admin.trips.index',compact('trips','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('admin.trips.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $validatedData = $this->validation($request->all());
        // $formData = $validatedData;
          $formData= $request->all();
        if ($request->hasFile('thumb')) {
            $img_path = Storage::disk('public')->put('trips_cover_thumb', $formData['thumb']);
            $formData['thumb'] = $img_path;
        }

        $newTrip = new Trip();
        $newTrip->fill($formData);
        $newTrip->id_user = Auth::id();
        dd($formData);
        $newTrip->save();
        return redirect()->route('admin.trips.show',['trip'=>$newTrip->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
        return view('admin.trips.show',compact('trip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
