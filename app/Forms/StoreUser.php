<?php
namespace App\Forms;

class StoreUser extends BaseForm
{
    /**
     * @var string $email
     */
    public $email;

    /**
     * @var string $password
     */
    public $password;

    /**
     * @var string $name
     */
    public $name;

    /**
     * Convert Instance to Array
     * @return array
     */
    public function toArray()
    {
        return [
            'password'                  => $this->password,
            'email'                     => $this->email,
            'name'                      => $this->name
        ];
    }

    /**
     * Rules for storing user
     * @return array
     */
    public function rules()
    {
        return [
            'password'      => 'required|min:6',
            'email'         => 'email|required|unique:users,email',
            'name'          => 'required'
        ];
    }
}
