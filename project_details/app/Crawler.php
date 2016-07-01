<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crawler extends Model
{
    protected $table= 'crawler';

    public $timestamps = false;



public static  function bubbleSort(array $arr)
{
 
    $n =sizeof($arr);
 
    for($i =1; $i < $n; $i++) {
 
        $flag =false;
 
        for($j = $n -1; $j >= $i; $j--) {
 
            if($arr[$j-1]> $arr[$j]) {
 
                $tmp = $arr[$j -1];
 
                $arr[$j -1]= $arr[$j];
 
                $arr[$j]= $tmp;
 
                $flag =true;
 
            }
 
        }
 
        if(!$flag) {
            break;
        }
    }
 
    return $arr;
}








}
