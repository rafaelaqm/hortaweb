<?php
namespace App\Services;

use App\Repositories\GroupRepository;
use App\Validators\GroupValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Database\QueryException;
use Exception;

class GroupService
{
    private $repository;
    private $validator;

    public function __construct(GroupRepository $repository, GroupValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function store(array $data) : array
    {
      try
      {
        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
        $group = $this->repository->create($data);

        return [
          'sucess'   => true,
          'messages' => "Grupo cadastrado",
          'data'     => $group,
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

    public function update($group_id, array $data) : array
    {
      try
      {
          $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
          $group = $this->repository->update($data, $group_id);

          return [
                  'sucess'   => true,
                  'messages' => "Grupo atualizado",
                  'data'     => $group,
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

    public function userStore($group_id, $data)
    {
      try
      {
        $group    = $this->repository->find($group_id);
        $user_id  = $data['user_id'];

        $group->users()->attach($user_id);


        return [
          'sucess'   => true,
          'messages' => "Usuário relacionado com sucesso!",
          'data'     => $group,
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
