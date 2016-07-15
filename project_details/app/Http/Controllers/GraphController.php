<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GraphController extends Controller
{

	public function indexPage(){
//echo '#'.substr(md5(rand()), 0, 6);
//echo dechex(rand(0x000000, 0xFFFFFF));


		//all type of  news category 
	     $types = \App\Crawler::where('overall',1)
		    //->where('is_goodOrBad',0)
		   ->select('type', \DB::raw('count(id) as news'))
            ->groupBy('type')
            ->get();

          //all good news category 
        $good_news = \App\Crawler::where('overall',1)
		   ->where('is_goodOrBad',0)
		   ->select('type as label', \DB::raw('count(id) as value'))
           ->groupBy('type')
           ->get();



           //all bad news category 
         $bad_news =  \App\Crawler::where('overall',1)
		   ->where('is_goodOrBad',1)
		   ->select('type as label', \DB::raw('count(id) as value'))
           ->groupBy('type')
           ->get();



        //women news
		 $women_news =  \App\Crawler::select( \DB::raw('count(id) as value'))
           ->groupBy('overall')
           ->get();


        //good news and bad news
		 $good_bad_news =  \App\Crawler::where('overall',1)
	    	->select( \DB::raw('count(id) as value'))
            ->groupBy('is_goodOrBad')
            ->get();
 



		return view('dashboard',compact('good_news'))
		->with('title', "Women Condition")
		->with([
                'type_group' =>  $types->lists('type'),
                'news_group' =>  $types->lists('news'),
        
                'good_bad' =>  $good_bad_news->lists('value'),

                'women_news' =>  $women_news->lists('value'),


                'bad_news_label' =>  $bad_news->lists('label'),
                'bad_news_value' =>  $bad_news->lists('value'),


                'good_news_label' =>  $good_news->lists('label'),
                'good_news_value' =>  $good_news->lists('value'),

                ]);
	}
    









}
