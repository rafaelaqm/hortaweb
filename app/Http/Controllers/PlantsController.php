<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PlantCreateRequest;
use App\Http\Requests\PlantUpdateRequest;
use App\Repositories\PlantRepository;
use App\Validators\PlantValidator;
use App\Entities\Institution;

class PlantsController extends Controller
{
    protected $repository;
    protected $validator;

    public function __construct(PlantRepository $repository, PlantValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index($institution_id)
    {
        $institution = Institution::find($institution_id);

        return view('institutions.plant.index', [
          'institution' => $institution
        ]);
    }

    public function store(Request $request, $institution_id)
    {
        try {

            $data                   = $request->all();
            $data['institution_id'] = $institution_id;


            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $plant = $this->repository->create($data);

            session()->flash('sucess', [
                'sucess'   => true,
                'messages' => "Hortaliça Cadastrada"
            ]);
            return redirect()->route('institution.plant.index', $institution_id);
          }

        catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function show($id)
    {
        $plant = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $plant,
            ]);
        }

        return view('plants.show', compact('plant'));
    }

    public function edit($id)
    {
        $plant = $this->repository->find($id);

        return view('plants.edit', compact('plant'));
    }

    public function update(PlantUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $plant = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Plant updated.',
                'data'    => $plant->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function destroy($institution_id, $plant_id)
    {
        $deleted = $this->repository->delete($plant_id);

        session()->flash('sucess', [
            'sucess'   => true,
            'messages' => "Hortaliça Removida."
        ]);
        return redirect()->back();
    }
}
