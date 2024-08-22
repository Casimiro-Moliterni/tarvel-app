<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        // Log dei dati ricevuti
        // \Log::info('Dati ricevuti:', $request->all());
        // Salva i dati se la validazione è superata
        try {
            $validatedData = $this->validation($request->all());
            $rating = new Rating();
            $rating->fill($validatedData);
            $rating->save();

            return response()->json(['status' => 'success', 'message' => 'Valutazione salvata con successo',], 200); // 200 OK
        } catch (\Exception $e) {
            // Restituisce una risposta JSON in caso di errore
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
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
                'stop_id' => 'nullable|integer|exists:stops,id',
                'trip_id' => 'required|integer|exists:trips,id',
                'rating' => 'required|numeric|between:0.5,5',
                'review' => 'nullable|string'
            ]
        )->validate();
    }
}
