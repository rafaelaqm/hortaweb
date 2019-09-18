<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MovimentCreateRequest;
use App\Http\Requests\MovimentUpdateRequest;
use App\Repositories\MovimentRepository;
use App\Validators\MovimentValidator;
use App\Entities\{Group, Plant, Moviment};
use Auth;

class MovimentsController extends Controller
{
    protected $validator;

    public function __construct(MovimentRepository $repository, MovimentValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index()
    {
      return view('moviment.index', [
        'plant_list' => Plant::all(),
      ]);
    }

    public function application()
    {
      $user       = Auth::user();
      $group_list = $user->groups->pluck('name', 'id');
      $plant_list = Plant::all()->pluck('name', 'id');

      return view('moviment.application', [
        'group_list' => $group_list,
        'plant_list' => $plant_list,
      ]);
    }

    public function storeApplication(Request $request)
    {
      $movimento = Moviment::create([
        'user_id'  => Auth::user()->id,
        'group_id' => $request->get('group_id'),
        'plant_id' => $request->get('plant_id'),
        'value'    => $request->get('value'),
        'type'     => 1,
      ]);

      session()->flash('sucess', [
        'sucess' => true,
        'messages' => "Seu investimento de R$ " . $movimento->value . " na hortaliça " . $movimento->plant->name . " foi realizada com Sucesso!",
      ]);

      return redirect()->route('moviment.application');
    }

    public function getback()
    {
      $user       = Auth::user();
      $group_list = $user->groups->pluck('name', 'id');
      $plant_list = Plant::all()->pluck('name', 'id');

      return view('moviment.getback', [
        'group_list' => $group_list,
        'plant_list' => $plant_list,
      ]);
    }

    public function storeGetBack(Request $request)
    {
      $movimento = Moviment::create([
        'user_id'  => Auth::user()->id,
        'group_id' => $request->get('group_id'),
        'plant_id' => $request->get('plant_id'),
        'value'    => $request->get('value'),
        'type'     => 2,
      ]);

      session()->flash('sucess', [
        'sucess' => true,
        'messages' => "Seu resgate de R$ " . $movimento->value . " na planta " . $movimento->plant->name . " foi realizada com Sucesso!",
      ]);

      return redirect()->route('moviment.application');
    }


    public function all()
    {
        $moviment_list = Auth::user()->moviments;
        return view('moviment.all', [
          'moviment_list' => $moviment_list,
        ]);
    }
}
