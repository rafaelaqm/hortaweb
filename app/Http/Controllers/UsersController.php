<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use App\Services\UserService;
use App\Entities\User;


class UsersController extends Controller
{
    protected $repository;
    protected $service;
    protected $validator;

    public function __construct(UserRepository $repository, UserService $service, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->service    = $service;
        $this->validator  = $validator;

    }

    public function index()
    {
        $users = $this->repository->all();

        return view('user.index',[
          'users' => $users,
        ]);
    }

    public function store(UserCreateRequest $request)
    {
        $request  = $this->service->store($request->all());
        $user     = $request['sucess'] ? $request['data'] : null;


        session()->flash('sucess', [
            'sucess'   => $request['sucess'],
            'messages' => $request['messages']
        ]);

        return redirect()->route('user.index');

    }

    public function show($id)
    {
        $user = $this->repository->find($id);

            return view('users.show',[
                'user' => $user,
            ]);
        }
    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', [
          'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
            $request  = $this->service->update($id, $request->all());
            $user     = $request['sucess'] ? $request['data'] : null;


            session()->flash('sucess', [
                'sucess'   => $request['sucess'],
                'messages' => $request['messages']
            ]);

            return redirect()->route('user.index');
    }

    public function destroy($id)
    {
      $deleted = $this->repository->delete($id);
      return redirect()->route('user.index');
    }


}
