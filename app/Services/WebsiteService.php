<?php
namespace App\Services;

use App\Forms\IForm;
use App\Models\Website;

class WebsiteService implements IService
{
    /**
     * @var Website $model
     */
    public $model;

    /**
     * WebsiteService constructor.
     * @param Website $model
     */
    public function __construct(Website $model)
    {
        $this->model = $model;
    }

    /**
     * @return Website[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(){
        return $this->model->all();
    }

    /**
     * @param IForm $form
     * @return mixed|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(IForm $form)
    {
        $form->validate();

        $website = new Website();
        $form->loadFromModel($website);
        $website->save();

        return $website;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->find($id);
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
