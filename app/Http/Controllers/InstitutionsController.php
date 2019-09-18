<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InstitutionCreateRequest;
use App\Http\Requests\InstitutionUpdateRequest;
use App\Repositories\InstitutionRepository;
use App\Validators\InstitutionValidator;
use App\Services\InstitutionService;
use App\Entities\Institution;

class InstitutionsController extends Controller
{
    protected $repository;
    protected $validator;
    protected $service;

    public function __construct(InstitutionRepository $repository, InstitutionValidator $validator, InstitutionService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service    = $service;
    }

    public function index()
    {
        $institutions = $this->repository->all();

        return view('institutions.index',[
            'institutions' => $institutions,
        ]);
    }

    public function store(InstitutionCreateRequest $request)
    {
      $request      = $this->service->store($request->all());
      $institution  = $request['sucess'] ? $request['data'] : null;

      session()->flash('sucess', [
          'sucess'   => $request['sucess'],
          'messages' => $request['messages']
      ]);

      return redirect()->route('institution.index');

    }

    public function show($id)
    {
        $institution = $this->repository->find($id);

        return view('institutions.show', [
          'institution' => $institution
        ]);
    }

    public function edit($id)
    {
        $institution = Institution::find($id);

        return view('institutions.edit', [
            'institution' => $institution,
          ]);
    }

    public function update(Request $request, $institution_id)
    {
      $request      = $this->service->update($institution_id, $request->all());

      session()->flash('sucess', [
          'sucess'   => $request['sucess'],
          'messages' => $request['messages']
      ]);

      return redirect()->route('institution.index');
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        return redirect()->route('institution.index');
    }
}
