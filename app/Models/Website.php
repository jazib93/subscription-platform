<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Website extends Model
{
    /**
     * @var array $fillable
     */
    protected $fillable = ['url'];

    /**
     * @return HasMany
     */
    public function posts()
    {
        return $this->HasMany('App\Models\Post');
    }

    /**
     * @return HasMany
     */
    public function subscribers()
    {
        return $this->HasMany('App\Models\Subscriber');
    }


}
