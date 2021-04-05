<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
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
     */
    public function store(ClientRequest $request)
    {
        $client = Client::create($request->validated());
        return $client;
    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     */
    public function show(Client $client)
    {
        return $client;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Client $client
     */
    public function update(ClientRequest $request, Client $client)
    {
        $client->fill($request->validated());
        $client->save();
        return $client;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @throws \Exception
     */
    public function destroy(Client $client)
    {
        if($client->delete()) {
            return response()->json($client, 204);
        }
    }
}
