<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stop;
use App\Models\Trip;
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
    public function create(Request $request)
    {

        // $day = $request->route('day');
        // dd($day);
        return view('admin.stops.create');
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
        $newStop->id_trip = Trip::id();

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
}
