<?php
namespace App\Forms;

class StorePost extends BaseForm
{
    /**
     * @var string $title
     */
    public $title;

    /**
     * @var string $description
     */
    public $description;

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
            'title'                  => $this->title,
            'description'            => $this->description,
            'website_id'             => $this->website_id
        ];
    }

    /**
     * Rules for storing post
     * @return array
     */
    public function rules()
    {
        return [
            'title'                 => 'required|max:255',
            'description'           => 'required',
            'website_id'            => 'required|exists:websites,id'
        ];
    }
}
