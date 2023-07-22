<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Traits\ExceptionTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class UserService
{
    use ExceptionTrait;
    private $userRepository;

    /**
     * Create a new service instance.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Retrieve index data.
     */
    public function index($parameters = [])
    {
        return $this->userRepository->getAll($parameters);
    }


    /**
     * Store row
    */
    public function store($user)
    {
        try
        {
            DB::beginTransaction();
            $user = $this->userRepository->create($user);
            DB::commit();
            return $user;
        }
        catch(Exception $exception)
        {
            DB::rollback();
            $this->logException('users', $user, $exception);
            return false;
        }
    }

    /**
     * Show row
    */
    public function show($id)
    {
        return $this->userRepository->show(['id' => $id]);
    }

    /**
     * Update row
    */
    public function update($user, $id)
    {
        try
        {
            DB::beginTransaction();
            $user = $this->userRepository->update($user, $id);
            DB::commit();
            return $user;
        }
        catch(Exception $exception)
        {
            DB::rollback();
            $this->logException('users', $user, $exception);
            return false;
        }
    }

    /**
     * Delete row
    */
    public function destroy($id)
    {
        try
        {
            DB::beginTransaction();
            $this->userRepository->delete($id);
            DB::commit();
            return true;
        }
        catch(Exception $exception)
        {
            DB::rollback();
            $this->logException('users', $id, $exception);
            return false;
        }
    }
}

?>
