<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stop;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $date = Carbon::createFromFormat('d M Y', $dateString)->format('Y-m-d');
        } catch (\Exception $e) {
            abort(400, 'Data non valida.');
        }

        return view('admin.stops.create', [
            'tripId' => $trip_id,
            'date' => $date
        ]);
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
        // dd($request->all());
        // $request->validate([
        //     'day' => 'required|date',
        //     'name' => 'required|string|max:255',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        //     'description' => 'nullable|string',
        //     'country' => 'nullable|string',
        //     'region' => 'nullable|string',
        //     'city' => 'required|string|max:255',
        //     'street' => 'nullable|string',
        //     'foods' => 'nullable|string',
        //     'curiosities' => 'nullable|string',
        //     'rating' => 'required|string|max:255',
        // ]);

        // Prepara i dati per l'inserimento
        $data = $request->all();
        // dd($data);

        // Gestione del file immagine se presente
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        // Crea una nuova istanza di Stop e salva nel database
        // istanza di un nuovo model 
        $newStop = new Stop();
        $newStop->fill($data);
        // dd($newStop);

        // Salva il nuovo Trip nel database
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
}
