<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stop;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($trip_id)
    {
        // // $day = $request->route('day');
        // // dd($day);
        // Verifica che l'ID del viaggio non sia nullo
        if (is_null($trip_id)) {
            abort(404, 'ID del viaggio non trovato.');
        }

        return view('admin.stops.create', ['tripId' => $trip_id]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        // Validazione dei dati
        $validatedData = $this->validation($request->all());
        $formData = $validatedData;

        // Gestione del file immagine se presente
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        // Crea una nuova istanza di Stop e salva nel database
        // istanza di un nuovo model 
        $newStop = new Stop();
        $newStop->fill($data);
        // $newStop->id_trip = Trip::id();

        // Salva il nuovo Trip nel database
        $newStop->save();

        // Redirect con messaggio di successo
        return redirect()->route('admin.stops.create')->with('success', 'Tappa aggiunta con successo!');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    private function validation($data) //----------------------------------------------------------------------------------------------------
    {
        return Validator::make(
            $data,
            [
                'day' => 'required|date',
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'description' => 'nullable|string',
                'foods' => 'nullable|string',
                'curiosities' => 'nullable|string',
                'rating' => 'required|string|max:255',
                'country' => 'nullable|string',
                'city' => 'nullable|string',
                'street' => 'nullable|string',
                'lonCountry' => 'nullable|numeric|between:-180,180',
                'latCountry' => 'nullable|numeric|between:-90,90',
                'lonStreet' => 'nullable|numeric|between:-180,180',
                'latStreet' => 'nullable|numeric|between:-90,90',
                'lonCity' => 'nullable|numeric|between:-180,180',
                'latCity' => 'nullable|numeric|between:-90,90',
                'time_start' => 'nullable',
                'time_end' => 'nullable'
            ],
            [

            ]
        )->validate();
    }
}