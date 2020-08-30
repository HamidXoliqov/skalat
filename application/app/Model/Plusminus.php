<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Plusminus extends Model
{
    //
    protected $table = 'tbl_plus_minus_price';

    protected $fillable = [
        'plus',
        'minus',
    ];
    public function edit($filds)
    {
        $this->fill($filds);
        $this->save();
    }

}
