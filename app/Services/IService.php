<?php
namespace App\Services;
use App\Forms\IForm;
use Illuminate\Http\Request;

/**
 * Interface IService
 * @package App\Services
 */
interface IService
{
    /**
     * @param IForm $form
     * @return mixed
     */
    public function store(IForm $form);

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id);

}
