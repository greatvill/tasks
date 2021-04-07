<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return mixed
     */
    public function store(UserRequest $request)
    {
        return UserService::save($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return mixed
     */
    public function show(User $user): mixed
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return mixed
     */
    public function update(UserRequest $request, User $user)
    {
        return UserService::update($user, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return mixed
     * @throws Exception
     */
    public function destroy(User $user): Response
    {
        if ($user->delete()) {
            return response()->success($user,
                \Symfony\Component\HttpFoundation\Response::HTTP_NO_CONTENT);
        } else {
           return response()->failed();
        }
    }
}
