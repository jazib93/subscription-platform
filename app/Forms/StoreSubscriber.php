<?php
namespace App\Forms;

class StoreSubscriber extends BaseForm
{
    /**
     * @var string $email
     */
    public $email;

    /**
     * @var int $website_id
     */
    public $website_id;

    /**
     * Convert Instance to Array
     * @return array
     */
    public function toArray()
    {
        return [
            'email'                     => $this->email,
            'website_id'                => $this->website_id
        ];
    }

    /**
     * Rules for storing subscriber
     * @return array
     */
    public function rules()
    {
        return [
            'email'         => 'email|required',
            'website_id'    => 'required'
        ];
    }
}
