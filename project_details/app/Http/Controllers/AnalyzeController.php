<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Crawler;

class AnalyzeController extends Controller
{
   


 		/**
 		*Analyze  the news, that the news is women news or not
 		*
 		*/
       public function areWomenNews(){

       	   set_time_limit(0);  //this will execute untill the job finished

       		$counter = Crawler::where('news_link', 'like', 'http://www.prothom-alo.com/bangladesh/article/%')
            					->get();


            			foreach ($counter as $i => $newsCounter) {

            				$string = $newsCounter->details;
            				
            				$words = array("নারী", "নারী হত্যা","ধর্ষণ","মেয়ে","যৌতুক",
            					"যৌন নির্যাতন","যৌন", "নির্যাতন","মা", "বউ", "মহিলা");

            				$sum = 0;
            				foreach($words as $word) {
							  //  $word." occurance are ".substr_count($string, $word)." times <br />";
								$total = substr_count($string, $word);
								$sum = $sum + $total;	
							}


							if($sum != 0){
								  Crawler::where('id', $newsCounter->id)->update([
						               'ovrrall' =>  1,
						            ]);
							}



							//Use the modulus operator to detect multiples of 10.
				             if ($i > 0 && $i % 10 == 0) {
				                   sleep(2);
				              }

            			}

       }











}
