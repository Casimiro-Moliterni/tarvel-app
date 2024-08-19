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
        // Validazione dei dati
        $validator = Validator::make($request->all(), [
            'trip_id' => 'required|integer|exists:trips,id',
            'stop_id' => 'nullable|integer|exists:stops,id',
            'rating' => 'required|integer|min:1|max:5', // Assicurati che la valutazione sia tra 1 e 5
            'review' => 'nullable|string|min:3', // La recensione deve essere di almeno 3 caratteri se fornita
        ]);

        if ($validator->fails()) {
            // Restituisci gli errori di validazione
            return response()->json([
                'status' => 'error',
                'message' => 'Errore di validazione dei dati',
                'errors' => $validator->errors(),
            ], 422); // 422 Unprocessable Entity
        }

        // Salva i dati se la validazione è superata
        try {
            $rating = new Rating();
            $rating->rating = $request->input('rating');
            $rating->review = $request->input('review');
            $rating->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Valutazione salvata con successo',
            ], 200); // 200 OK
        } catch (\Exception $e) {
            // Gestisci gli errori generali
            return response()->json([
                'status' => 'error',
                'message' => 'Errore durante il salvataggio dei dati',
                'error' => $e->getMessage(),
            ], 500); // 500 Internal Server Error
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
                'rating' => 'required|min:0.5|max:5',
                'review' => 'nullable|string'
            ]
        )->validate();
    }
}
