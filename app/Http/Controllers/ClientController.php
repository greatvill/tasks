<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Client::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClientRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ClientRequest $request): \Illuminate\Http\JsonResponse
    {
        $client = Client::create($request->validated());
        return \response()->json($client);
    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     * @return Response
     */
    public function show(Client $client)
    {
        return $client;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ClientRequest $request, Client $client)
    {
        $client->fill($request->except(['game_id']));
        $client->save();
        return response()->json($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @return Response
     * @throws \Exception
     */
    public function destroy(Client $client)
    {
        if($client->delete()) {
            return response(null, 204);
        }
    }
}
