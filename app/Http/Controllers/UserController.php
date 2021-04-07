<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;
    /**
     * @var UserService
     */
    private UserService $userService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserService $userService
    )
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        if ($search = $request->input('search')) {
            return $this->userRepository->findByStringSearch($search);
        }
        return $this->userRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return mixed
     */
    public function store(UserRequest $request)
    {
        return $this->userService->save($request->validated());
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
        return $this->userService->update($user->id, $request->validated());
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
