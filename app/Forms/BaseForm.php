<?php
namespace App\Forms;

use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Validation\Concerns\ValidatesAttributes;
use Symfony\Component\VarDumper\VarDumper;
abstract class BaseForm implements IForm
{
    /**
     * @return \Illuminate\Support\MessageBag|mixed
     */
    public function errors(){
        return $this->getValidator()->errors();
    }

    /**
     * @return bool
     */
    public function passes(){
        return $this->getValidator()->passes();
    }

    /**
     * @return bool
     */
    public function fails(){
        return $this->getValidator()->fails();
    }

    /**
     * @return array|mixed
     */
    public function errorMessages()
    {
        return [];
    }

    /**
     * @param $params
     */
    public function loadFromArray($params){
        foreach ($params as $key => $value){
            if( property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }

    /**
     * @param $model
     */
    public function loadFromModel($model){
        $keys = $model->getFillable();
        foreach($keys as $key){
            if(property_exists($this, $key) || !empty($this->$key)){
                $model->$key = $this->$key;
            }
        }
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function getValidator(){
        $validator = Validator::make($this->toArray(), $this->rules(), $this->errorMessages());
        return $validator;
    }

    /**
     * @return mixed|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate()
    {
        $this->getValidator()->validate();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function nameToClass($name){
        return str_replace(
            ['  ', ' '],
            '_',
            trim(
                str_replace(
                    ['/' , '&', ')', '(', '-', '%', '?'],
                    '',
                    strtolower($name)
                )
            )
        );
    }
}
