<?php
namespace App\Forms;

use Illuminate\Validation\Rule;
class LoginForm extends BaseForm
{
    /**
     * @var $email
     */
    public $email;

    /**
     * @var string $password
     */
    public $password;

    /**
     * Convert Instance to Array
     * @return array
     */
    public function toArray()
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }

    /**
     * Rules for Login Form
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'email|required|exists:users,email',
            'password' => 'required'
        ];
    }

}
