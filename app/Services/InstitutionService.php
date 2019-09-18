<?php
namespace App\Services;

use App\Repositories\InstitutionRepository;
use App\Validators\InstitutionValidator;
use Prettus\Validator\Contracts\ValidatorInterface;



class InstitutionService
{
    private $repository;
    private $validator;

    public function __construct(InstitutionRepository $repository, InstitutionValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function store(array $data) : array
    {
        try
        {
          $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
          $institution = $this->repository->create($data);

          return [
            'sucess'   => true,
            'messages' => "Instituição cadastrada",
            'data'     => $institution,
          ];
        }
        catch (Exception $e)
        {
            switch (get_class($e))
            {
              case QueryException::class     : return ['sucess' => false, 'messages' => $e->getMessage()];
              case ValidatorException::class : return ['sucess' => false, 'messages' => $e->getMessageBag()];
              case Exception::class          : return ['sucess' => false, 'messages' => $e->getMessage()];
              default                        : return ['sucess' => false, 'messages' => get_class($e)];
            }
        }
      }

        public function update($id, array $data) : array
        {
              try
              {
                $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
                $institution = $this->repository->update($data, $id);

                return [
                  'sucess'   => true,
                  'messages' => "Instituição atualizada",
                  'data'     => $institution,
                ];

              }
              catch (Exception $e)
              {
                  switch (get_class($e))
                  {
                    case QueryException::class     : return ['sucess' => false, 'messages' => $e->getMessage()];
                    case ValidatorException::class : return ['sucess' => false, 'messages' => $e->getMessageBag()];
                    case Exception::class          : return ['sucess' => false, 'messages' => $e->getMessage()];
                    default                        : return ['sucess' => false, 'messages' => get_class($e)];
                  }
              }
        }
    }
