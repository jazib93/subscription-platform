<?php
namespace App\Forms;

class StoreWebsite extends BaseForm
{
    /**
     * @var string $url
     */
    public $url;

    /**
     * Convert Instance to Array
     * @return array
     */
    public function toArray()
    {
        return [
            'url'                  => $this->url,
        ];
    }

    /**
     * Rules for storing website
     * @return array
     */
    public function rules()
    {
        return [
            'url'      => 'required|url'
        ];
    }
}
