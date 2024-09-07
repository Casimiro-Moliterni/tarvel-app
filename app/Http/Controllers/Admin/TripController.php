<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Rating;
use App\Models\Stop;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ottieni l'ID dell'utente autenticato
        $user = Auth::id();
    
        // Recupera i viaggi creati dall'utente
        $trips = Trip::where('id_user', $user)
            ->orderBy('created_at', 'desc')
            ->get();
    
        // Recupera i viaggi condivisi con l'utente (non creati dall'utente)
        $tripsFriend = Trip::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user);  // Controlla la tabella pivot per i viaggi condivisi
        })
        ->where('id_user', '!=', $user)  // Escludi i viaggi creati dall'utente
        ->orderBy('created_at', 'desc')
        ->get();
    
        // Restituisce la vista con entrambi i viaggi
        return view('admin.trips.index', compact('trips', 'tripsFriend', 'user'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //----------------------------------------------------------------------------------------------------------------
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
    public function store(Request $request) //-------------------------------------------------------------------------------------------------
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

        // ---------------
        // Calcola il numero di giorni e inserisci i record nella tabella days
        // $start = Carbon::parse($newTrip->start_date);
        // $end = Carbon::parse($newTrip->end_date);


        // ---------------

        // Effettua il redirect utilizzando l'ID del nuovo Trip
        return redirect()->route('admin.trips.show', ['trip' => $newTrip->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //---------------------------------------------------------------------------------------------------------------
    {
        // Recupera il viaggio con l'ID specificato
        $trip = Trip::find($id);

        // Verifica se il viaggio esiste
        if (!$trip) {
            abort(404, 'Trip not found');
        }
        //  dd($trip);
        // Calcola tutti i giorni tra start_date e end_date
        $startDate = Carbon::parse($trip->start_date);
        $endDate = Carbon::parse($trip->end_date);
        $daysRange = $startDate->toPeriod($endDate);
        // dd( $trip->rating);
        // Recupera tutti gli eventi del viaggio per il giorno preciso
        $events = Stop::where('id_trip', $id)->orderBy('time_start', 'asc')->get()->groupBy(function ($event) {
            return Carbon::parse($event->day)->format('d M Y');
        });


        $ratings = Stop::with('ratings')->where('id_trip', $id)->get(); // Recupera le tappe con i loro rating
        // dd($ratings);
        // Passa i dati alla vista
        return view('admin.trips.show', compact('trip', 'daysRange', 'events', 'ratings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip) //-------------------------------------------------------------------------------------------------
    {
        //
        // $trip = Trip::where($id);
        return view('admin.trips.edit', compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip) //-------------------------------------------------------------------------------------
    {
        // Raccogli i dati dal form
        $formData = $request->all();

        // Validazione dei dati
        $validatedData = $this->validation($request->all());
        $formData = $validatedData;

        // Controlla se è stata caricata una nuova immagine
        if ($request->hasFile('thumb')) {
            // Elimina l'immagine precedente, se esiste
            if ($trip->thumb) {
                Storage::disk('public')->delete($trip->thumb);
            }
            // Salva la nuova immagine
            $imgPath = Storage::disk('public')->put('trips_cover_thumb', $request->file('thumb'));
            $formData['thumb'] = $imgPath;
        }

        // --------------------

        // Redirect all'index o dove preferisci dopo l'aggiornamento
        return redirect()->route('admin.trips.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip) //-------------------------------------------------------------------------------------------------
    {
        $trip->delete();
        session()->flash('trips_deleted', true);
        return redirect()->route('admin.trips.index');
    }

    // logica del softdeletes
    public function indexDeleted(Trip $trips) //---------------------------------------------------------------------------------------------
    {
        $trips = Trip::onlyTrashed()->get();
        return view('admin.garbage.index', compact('trips'));
    }

    public function restore($id) //----------------------------------------------------------------------------------------------------------
    {
        $trip = Trip::withTrashed()->findOrFail($id);
        $trip->restore();
        session()->flash('trips_restore', true);
        return redirect()->route('admin.trips.index')->with('status', 'User restored successfully.');
    }

    public function restoreAll() //--------------------------------------------------------------------------------------------------------
    {
        Trip::onlyTrashed()->restore();
        session()->flash('trips_restoreAll', true);
        return redirect()->route('admin.trips.index')->withSuccess(__('All users restored successfully.'));
    }


    // validatore 
    private function validation($data) //----------------------------------------------------------------------------------------------------
    {
        return Validator::make(
            $data,
            [
                'title' => 'required|min:3|string|max:255',
                'description' => 'nullable|min:5|string',
                'thumb' => 'nullable|image|max:1700',
                'country' => 'required|string',
                'city' => 'nullable|string',
                'lonCountry' => 'required|numeric|between:-180,180',
                'latCountry' => 'required|numeric|between:-90,90',
                'lonCity' => 'nullable|numeric|between:-180,180',
                'latCity' => 'nullable|numeric|between:-90,90',
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
                'country.required' => 'Il campo Paese è obbligatorio',
            ]
        )->validate();
    }

    // app/Http/Controllers/TripController.php
    public function joinTrip(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string',
        ]);
    
        // Trova il viaggio tramite il codice
        $trip = Trip::where('code', $validated['code'])->first();
    
        if (!$trip) {
            return response()->json(['message' => 'Codice non valido.'], 404);
        }
    
        // // Verifica che l'utente non sia già partecipante del viaggio
        // if ($trip->users()->where('user_id', auth()->id())->exists()) {
        //     return response()->json(['message' => 'Sei già nel viaggio.'], 400);
        // }
    
        // Aggiungi l'utente come partecipante al viaggio originale
        $trip->users()->attach(auth()->id());
    dd( auth()->id());

        // Crea una copia del viaggio per l'utente, con un nuovo codice
        $newTrip = Trip::create([
            'title' => $trip->title,
            'description' => $trip->description,
            'id_user' => auth()->id(),  // Qui passiamo l'ID dell'utente autenticato
            'thumb' => $trip->thumb,
            'country' => $trip->country,
            'city' => $trip->city,
            'start_date' => $trip->start_date,
            'end_date' => $trip->end_date,
            'lonCountry' => $trip->lonCountry,
            'latCountry' => $trip->latCountry,
            'lonCity' => $trip->lonCity,
            'latCity' => $trip->latCity,
            'code' => $trip->code,   // Genera un nuovo codice univoco per il viaggio duplicato
        ]);
    
        // return response()->json([
        //     'message' => 'Sei stato aggiunto al viaggio esistente e un nuovo viaggio è stato creato per te!',
        //     'new_trip_code' => $newTrip->code  // Restituisce il codice del nuovo viaggio
        // ]);
        return view('admin.trips.show');
    }
    



}
