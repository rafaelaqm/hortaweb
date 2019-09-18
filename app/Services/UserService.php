<?php
namespace App\Services;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Database\QueryException;
use Exception;

class UserService
{
  private $repository;
  private $validator;

  public function __construct(UserRepository $repository, UserValidator $validator)
  {
      $this->repository = $repository;
      $this->validator  = $validator;
  }

  public function store($data)
  {
    try
    {
      $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
      $user = $this->repository->create($data);

      return [
        'sucess'   => true,
        'messages' => "Usuário cadastrado",
        'data'     => $user,
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
        $user = $this->repository->update($data, $id);

        return [
          'sucess'   => true,
          'messages' => "Usuário atualizado",
          'data'     => $user,
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
  public function destroy($user_id)
  {
    try
    {
      $this->repository->delete($user_id);


      return [
        'sucess'   => true,
        'messages' => "Usuário removido",
        'data'     => null,
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
