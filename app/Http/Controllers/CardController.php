<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardRequest;
use App\Models\Card;
use Illuminate\Http\Response;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return Card::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CardRequest $request
     * @return mixed
     */
    public function store(CardRequest $request): mixed
    {
        try {
            return Card::create($request->validated());
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Card $card
     * @return Response
     */
    public function show(Card $card)
    {
        return $card;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CardRequest $request
     * @param Card $card
     */
    public function update(CardRequest $request, Card $card)
    {
        $card->fill($request->validated());
        $card->save();
        return $card;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Card $card
     */
    public function destroy(Card $card)
    {
        if($card->delete()) {
            return response()->json($card, 204);
        }
    }
}
