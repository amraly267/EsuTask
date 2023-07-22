<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ResponseTrait, ResponseTrait;
    private $userService;

    /**
     * Create a new controller instance
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userService->index($this->indexParameters($request));
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $isSavedUser = $this->userService->store($request->all());
        if($isSavedUser)
        {
            $this->successResponse('Data has been saved successfully!');
            return redirect()->route('users.index');
        }

        return $this->failedResponse('Data has not saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userService->show($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userService->show($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = $request->all();
        if(!$user['password'])
        {
            unset($user['password']);
        }

        $isSavedUser = $this->userService->update($user, $id);
        if($isSavedUser)
        {
            $this->successResponse('Data has been saved successfully!');
            return redirect()->route('users.index');
        }

        return $this->failedResponse('Data has not saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeletedUser = $this->userService->destroy($id);
        if($isDeletedUser)
        {
            $this->successResponse('Data has been deleted successfully!');
            return redirect()->route('users.index');
        }

        return $this->failedResponse('Data has not deleted successfully');
    }

    /**
     * Index parameters
     */
    private function indexParameters($request)
    {
        $parameters = $request->all();
        $parameters['per_page'] = 10;
        return $parameters;
    }

}
