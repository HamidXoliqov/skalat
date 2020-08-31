<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Classes\table;
use App\Model\People;
use Illuminate\Support\Facades\Auth;

class ReportPrice extends Model
{
    protected $table = 'tbl_people_reports';

    protected $fillable = [
        'people_id',
        'user_id',
        'date',
        'statr_date',
        'end_date',
        'plus_date',
        'minus_date',
        'bonus',
        'name',
        'first_name',
        'last_name',
        'position',
        'price',
        'summ',
        'reason',
    ];
    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        self::creating(function ($model){
            $str = $model['name'];
            $lastname = explode(",",$str)[0];
            $firstname = explode(",",$str)[1];
//            $data = People::where(['lastname'=>$lastname,'firstname'=>$firstname])->first();
            $data = People::where([['lastname','=',$lastname]])->first();
            $model->people_id =  $data['id'];
            $model->user_id =  Auth::id();
            $model->last_name = $lastname;
            $model->first_name = $firstname;
            $model->position = $data['mi'];
            $model->price = $data['price'];
//            die($data);

        });
    }
    public static function add($filds)
    {
        $post = new static;
        $post->fill($filds);
        $post->save();
    }
    public function edit($filds)
    {
        $this->fill($filds);
        $this->totalhours = ReportPrice::totalhours($filds['statr_date'],$filds['end_date']);
        $this->minus_date = ReportPrice::minustime($filds['statr_date']);
        $this->plus_date = ReportPrice::plustime($filds['end_date']);
//        dd(explode(":",$filds['statr_date'])[1]);
        $this->save();
    }
    //--------------------
    public static function totalhours($start,$end)
    {
        if($start)
        {
            $start_min = intval(explode(":",$start)[0]);
            $start_sec = intval(explode(":",$start)[1]);
        }
        if($end)
        {
            $end_min = intval(explode(":",$end)[0]);
            $end_sec = intval(explode(":",$end)[1]);
        }
        if($end_sec - $start_sec>=0 && $end_min-$start_min>=0)
        {
            $nat_min = intval($end_min-$start_min);
            $nat_sec = intval($end_sec-$start_sec);
        }
        else
        {
            $nat_min = $end_min-$start_min-1;
            $nat_sec = 60 - $end_sec-$start_sec;
        }
        return $nat_min.' : '.$nat_sec;
    }
    //--------------
    public static function minustime($time)
    {
        if($time)
        {
            $min = intval(explode(":",$time)[0]);
            $sec = intval(explode(":",$time)[1]);
        }
        if (9<=$min)
        {
            $natmin = $min-9;
            $natsec = $sec;
        }
        else
        {
            $natmin = 9-$min;
            $natsec = $sec;
        }
        return $natmin.':'.$sec;
    }
    //------------------
    public static function plustime($time)
    {
        if($time)
        {
            $min = intval(explode(":",$time)[0]);
            $sec = intval(explode(":",$time)[1]);
        }
        if (18<=$min)
        {
            $natmin = $min-18;
            $natsec = $sec;
        }
        else
        {
            $natmin = 18-$min;
            $natsec = $sec;
        }
        return $natmin.':'.$sec;
    }
}
