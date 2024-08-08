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
        return view('admin.trips.index', compact('trips', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.trips.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // form data prende i dati degli input 
        $formData = $request->all();
        // validazione dei dati 
        $validatedData = $this->validation($request->all());
        // forma data diventa positvo 
        $formData = $validatedData;
       
        // creimao una nuova cartella public per passare l'immagine di copertina 
        if ($request->hasFile('thumb')) {
            $img_path = Storage::disk('public')->put('trips_cover_thumb', $formData['thumb']);
            $formData['thumb'] = $img_path;
        }

        // istanza di un nuovo model 
        $newTrip = new Trip();
        $newTrip->fill($formData);
        $newTrip->id_user = Auth::id();

        // Salva il nuovo Trip nel database
        $newTrip->save();

        // Effettua il redirect utilizzando l'ID del nuovo Trip
        return redirect()->route('admin.trips.show', ['trip' => $newTrip->id]);
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



        // Crea istanze Carbon dalle date
        $start = Carbon::parse($trip->start_date);
        $end = Carbon::parse($trip->end_date);

        // Calcola la differenza in giorni
        $differenceInDays = $start->diffInDays($end);

        // Calcola la differenza in ore
        $differenceInHours = $start->diffInHours($end);

        // Calcola la differenza in minuti
        $differenceInMinutes = $start->diffInMinutes($end);

        // Calcola la differenza totale come oggetto CarbonInterval
        $difference = $start->diff($end);

        $days  = $differenceInDays;
        return view('admin.trips.show', compact('trip', 'days'));
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


    // validatore 
    private function validation($data)
{
    return Validator::make($data, [
        'title' => 'required|min:3|string|max:255',
        'description' => 'nullable|min:5|string',
        'thumb' => 'nullable|image|max:1700',
        'address' => 'required|string',
        'longitude' => 'required|numeric|between:-180,180',
        'latitude' => 'required|numeric|between:-90,90',
        'end_date' => 'required|date|after_or_equal:start_date',  // Modificato
        'start_date' => [
            'required', 
            'date',
            'after_or_equal:today',  // Già modificato
        ],
    ], 
    [
        'title.required' => 'Il campo titolo è obbligatorio',
        'end_date.required' => 'Il campo Data di Ritorno è obbligatorio',
        'end_date.after_or_equal' => 'Il campo Data di Ritorno non può essere inferiore alla Data di Inizio',  // Modificato
        'start_date.required' => 'Il campo Data di Inizio è obbligatorio',
        'start_date.after_or_equal' => 'Il campo Data di Inizio non può essere inferiore ad oggi',
        'title.min' => 'Il campo titolo deve essere almeno di 3 caratteri',
        'description.min' => 'Il campo descrizione deve essere almeno di 5 caratteri',
        'thumb.image' => 'Il file deve essere un\'immagine',
        'thumb.max' => 'L\'immagine non può superare i 1700KB',
        'address.required' => 'Il campo indirizzo è obbligatorio',
        'longitude.required' => 'Il campo longitudine è obbligatorio',
        'longitude.between' => 'Il campo longitudine deve essere compreso tra -180 e 180',
        'latitude.required' => 'Il campo latitudine è obbligatorio',
        'latitude.between' => 'Il campo latitudine deve essere compreso tra -90 e 90',
    ])->validate();
}

}    

