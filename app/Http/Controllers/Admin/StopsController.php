<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stop;
use App\Models\Trip;
use Carbon\Carbon;
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

    public function create(Request $request, $trip_id)
    {
        // Recupera la data dalla query string
        $dateString = $request->query('date');

        // Verifica che l'ID del viaggio non sia nullo
        if (is_null($trip_id)) {
            abort(404, 'ID del viaggio non trovato.');
        }

        // Converti la data in formato Y-m-d
        try {
            $date = Carbon::createFromFormat('d M Y', $dateString);
        } catch (\Exception $e) {
            abort(400, 'Data non valida.');
        }

        return view('admin.stops.create', ['tripId' => $trip_id, 'date' => $date]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Estrai i dati dalla richiesta
        $data = $request->all();

        // Ottieni l'id_trip dai dati della richiesta
        $trip_id = $data['id_trip'];

        // Validazione dei dati
        $validatedData = $this->validation($data, $trip_id);

        // Gestione del file immagine se presente
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Converti gli orari in oggetti Carbon per facilitare il confronto
        $newStart = Carbon::createFromFormat('H:i', $data['time_start']);
        $newEnd = Carbon::createFromFormat('H:i', $data['time_end']);


        // Recupera tutte le tappe esistenti per il giorno e viaggio specificato
        $existingStops = Stop::where('id_trip', $trip_id)->where('day', $data['day'])->get();

        // Verifica sovrapposizioni di orario
        foreach ($existingStops as $stop) {
            $existingStart = Carbon::createFromFormat('H:i', $stop->time_start);
            $existingEnd = Carbon::createFromFormat('H:i', $stop->time_end);
            // Esegui il dump degli orari di inizio e fine
            dd($existingStart->format('H:i'), $existingEnd->format('H:i'));

            // Verifica se c'è sovrapposizione
            if (($newStart->notEqualTo($existingStart)) && ($newEnd->notEqualTo($existingEnd))) {
                // Sovrapposizione trovata
                dd('Errore: Orario sovrapposto', $newStart->format('H:i'), $newEnd->format('H:i'));
            }
        }
        // Crea una nuova istanza di Stop e salva nel database
        $newStop = new Stop();
        $newStop->fill($validatedData);
        $newStop->save();

        // Redirect con messaggio di successo
        return redirect()->route('admin.trips.show', ['trip' => $newStop->id_trip])->with('success', 'Tappa aggiunta con successo!');
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
    private function validation($data)
    {
        // Prima validazione base
        $validator = Validator::make(
            $data,
            [
                'day' => 'required|date',
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'description' => 'nullable|string',
                'foods' => 'nullable|string',
                'country' => 'nullable|string',
                'city' => 'nullable|string',
                'street' => 'nullable|string',
                'curiosities' => 'nullable|string',
                'rating' => 'required|string|max:255',
                'id_trip' => 'required|integer|exists:trips,id',
                'lonCountry' => 'nullable|numeric|between:-180,180',
                'latCountry' => 'nullable|numeric|between:-90,90',
                'lonStreet' => 'nullable|numeric|between:-180,180',
                'latStreet' => 'nullable|numeric|between:-90,90',
                'lonCity' => 'nullable|numeric|between:-180,180',
                'latCity' => 'nullable|numeric|between:-90,90',
                'time_start' => 'required|date_format:H:i',
                'time_end' => 'required|date_format:H:i|after:time_start'
            ],
            [
                'id_trip.required' => 'Il campo id_trip è obbligatorio.',
                'id_trip.integer' => 'Il campo id_trip deve essere un numero intero.',
                'id_trip.exists' => 'Il viaggio selezionato non esiste.',
                'time_start.required' => 'L\'orario di inizio è obbligatorio.',
                'time_end.required' => 'L\'orario di fine è obbligatorio.',
                'time_start.date_format' => 'Il formato dell\'ora di inizio non è valido.',
                'time_end.date_format' => 'Il formato dell\'ora di fine non è valido.',
                'time_end.after' => 'L\'orario di fine deve essere successivo all\'orario di inizio.',
            ]
        );

        return $validator->validate();
    }



}