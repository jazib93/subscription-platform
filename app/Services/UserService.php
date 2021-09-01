<?php
namespace App\Services;

use App\Forms\IForm;
use App\Models\User;

class UserService implements IService
{
    /**
     * @var User $userModel
     */
    public $userModel;

    /**
     * UserService constructor.
     * @param User $userModel
     */
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * @param IForm $form
     * @return mixed|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(IForm $form)
    {
        $form->validate();

        $user = new User();
        $form->loadFromModel($user);
        $user->save();

        return $user;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->userModel->find($id);
    }

    /**
     * @param $email
     * @return mixed
     */
    public function findByEmail($email)
    {
        return $this->userModel->where('email', $email)->first();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {
        // TODO: Implement remove() method.
    }
}
