<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

    protected $uploads = '/images/';

    protected $fillable = ['file'];

    /*creo Accessor per "ritornare" giusto PATH
    alla photo dello user*/

    public function getFileAttribute($photo){

        return $this->uploads . $photo;

    }



}
