<?php
namespace App\Services;

use App\Forms\IForm;
use App\Models\Subscriber;

class SubscriberService implements IService
{
    /**
     * @var Subscriber $model
     */
    public $model;

    /**
     * SubscriberService constructor.
     * @param Subscriber $model
     */
    public function __construct(Subscriber $model)
    {
        $this->model = $model;
    }

    /**
     * @param IForm $form
     * @return mixed|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(IForm $form)
    {
        $form->validate();

        //check if this subscriber
        //already exists
        if($this->checkSubscriber($form->toArray())){

            $subscriber = new Subscriber();
            $form->loadFromModel($subscriber);
            $subscriber->save();

            return $subscriber;
        }

        return false;
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

    private function checkSubscriber($data){
        $subscriber = $this->model->where([
            'website_id' => $data['website_id'],
            'email' => $data['email']
        ])->first();

        if($subscriber){
            return false;
        }else{
            return true;
        }
    }
}
