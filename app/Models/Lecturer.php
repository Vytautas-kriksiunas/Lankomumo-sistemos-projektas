<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    public function subjects(){
        return $this->hasMany(Subject::class);
    }

    #[Scope]
    protected function filterRecords(Builder $query, $name=null, $surname=null, $email=null){
        if ($name!=null)
            $query->where('name','like', "%$name%");

        if ($surname!=null)
            $query->where('surname','like', "%$surname%");

        if ($email!=null)
            $query->where('email','like', "%$email%");
    }

}
