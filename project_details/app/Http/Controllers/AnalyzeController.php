<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Crawler;

class AnalyzeController extends Controller
{
   


 		/**
 		* Divide women news from all news 
 		*
 		*/
       public function areWomenNews(){

       	   set_time_limit(0);  //this will execute untill the job finished

       		$counter = Crawler::where('news_link', 'like', 'http://www.prothom-alo.com/bangladesh/article/%')
            					->get();


            			foreach ($counter as $i => $newsCounter) {

            				$string = $newsCounter->title;
            				

            				$words = array("নারী","ধর্ষণ","মেয়ে","যৌতুক",
            					"কিশোরী","পরিচারিকা", "তরুণী",
            					 "পরকীয়া", "পরকিয়া", "নারি", "গৃহবধূর"
							 );

            				$sum = 0;
            				foreach($words as $word) {
							  //  $word." occurance are ".substr_count($string, $word)." times <br />";
								$total = substr_count($string, $word);
								$sum = $sum + $total;	
							}


							if($sum != 0){
								  Crawler::where('id', $newsCounter->id)->update([
						               'overall' =>  1,
						            ]);
							}else{

									$string = $newsCounter->details;
		            				$words = array("ধর্ষণ","যৌতুক",
		            					"কিশোরী", "তরুণী",
		            					 "পরকীয়া", "পরকিয়া","গৃহবধূর"
									 );

		            				$sss  = 0;
		            				foreach($words as $word) {
										$total = substr_count($string, $word);
										$sss = $sss + $total;	
									}

									if($sss != 0){

									    Crawler::where('id', $newsCounter->id)->update([
							               'overall' =>  1,
							            ]);
									}else{

								        Crawler::where('id', $newsCounter->id)->update([
								               'overall' =>  0,
								        ]);
									}

							}

							//Use the modulus operator to detect multiples of 10.
				             if ($i > 0 && $i % 10 == 0) {
				                   sleep(1);
				              }

            			}

       }














       /**
       *
       *Divide good news and bad news from all women news
       *
       */
		public function areGoodOrBad(){

			 set_time_limit(0);  //this will execute untill the job finished

       		$counter = Crawler::where('overall', '=', 1)   //all women news 
            					->get();


            			foreach ($counter as $i => $newsCounter) {

            				$string = $newsCounter->title;
            				
            				// specific word for count their frequency
            		        $words = array("ধর্ষণ", "যৌতুক", "মৃত্যু", "জখম",
            					"পরিচারিকা", "হত্যা" , "নির্যাতন", 
            					 "পরকীয়া", "পরকিয়া", "খুন", "শারীরিক", 
            					 "অত্যাচার", "যৌন", "নিহত" , "মামলা", "লাশ", "গুরুতর",
            					  "আহত"
							 );

            				$sum = 0;
            				foreach($words as $word) {
							    $total3 = substr_count($string, $word);
								$sum = $sum + $total3;	
							}


							if($sum != 0){
								  Crawler::where('id', $newsCounter->id)->update([
						               'is_goodOrBad' =>  1,    // 1 means the news is bad 
						            ]);
							}else{

									$string = $newsCounter->details;
		            				$wordes = array("ধর্ষণ", "যৌতুক", "মৃত্যু", "জখম", 
		            					"পরিচারিকা", "হত্যা" , "নির্যাতন", 
		            					 "পরকীয়া", "পরকিয়া", "খুন", "শারীরিক", 
		            					 "অত্যাচার", "যৌন", "নিহত", "মামলা", "লাশ" ,
		            					 "গুরুতর", "আহত"
									 );

		            				$sss  = 0;
		            				foreach($wordes as $word) {
										$total = substr_count($string, $word);
										$sss = $sss + $total;	
									}

									if($sss != 0){

										Crawler::where('id', $newsCounter->id)->update([
							               'is_goodOrBad' =>  1,
							            ]);

									}else{

								        Crawler::where('id', $newsCounter->id)->update([
								               'is_goodOrBad' =>  0,
								        ]);
									}

							}

							//Use the modulus operator to detect multiples of 10.
				             if ($i > 0 && $i % 10 == 0) {
				                   sleep(1);
				              }

            			}

		}













	 /**
       *
       *Divide all bad news into different category 
       *
       */
		public function badNewsCategorized(){

			 set_time_limit(0);  //this will execute untill the job finished

       		$counter = Crawler::where('overall', '=', 1)  //all women news 
       							->where('is_goodOrBad',1) //all bad news
            					->get();


            			foreach ($counter as $i => $newsCounter) {

            				$string = $newsCounter->details;
            				
       						//++++++++++++Rape++++++++++++++
            		        $word ="ধর্ষণ";
						    $rape = substr_count($string, $word);
								
							

						    //++++++++++++Rape++++++++++++++
            		        $word ="আত্মহত্যা";
						    $suicide = substr_count($string, $word);
								
						
                            //+++++++++++Domestic Violence ++++++
                            $words = array(
		            			"নির্যাতন", "পরকীয়া", "পরকিয়া",
		            			"শারীরিক", "অত্যাচার"
							);

		            		$domestic   = 0;
		            		foreach($words as $word) {
								$total1 = substr_count($string, $word);
								$domestic = $domestic + $total1;	
							}



							//+++++++++++Murder++++++
							$words = array("হত্যা" , "খুন","নিহত", "লাশ", "মৃত্যু","দুর্ঘটনা", "আহত" );

		            		$murder   = 0;
		            		foreach($words as $word) {
								$total2 = substr_count($string, $word);
								$murder = $murder + $total2;	
							}


 							//+++++++++++Doury++++++

                            $word ="যৌতুক";
						    $doury = substr_count($string, $word);


						    //+++++++++++sexual_harassment++++++
							$words = array("যৌন", "ইভটিজিং", "বখাটে", "উত্যক্ত" );

		            		$sexual    = 0;
		            		foreach($words as $word) {
								$total3 = substr_count($string, $word);
								$sexual = $sexual + $total3;	
							}

								

                             

                            //==========Database Update==========================

							Crawler::where('id', $newsCounter->id)->update([
								               'rape' => $rape,
								               'suicide' =>  $suicide,
								               'domestic_violence' => $domestic,
								               'doury' => $doury,
								               'sexual_harassment' => $sexual,
								               'murder' =>  $murder,
								        ]);

							//==================================================


							//Use the modulus operator to detect multiples of 10.
				             if ($i > 0 && $i % 10 == 0) {
				                   sleep(1);
				              }

            			}

		}










	 /**
       *
       *Divide all good news into different category 
       *
       */
		public function goodNewsCategorized(){

			 set_time_limit(0);  //this will execute untill the job finished

       		$counter = Crawler::where('overall', '=', 1)  //all women news 
       							->where('is_goodOrBad',0) //all good news
            					->get();


            			foreach ($counter as $i => $newsCounter) {

            				$string = $newsCounter->details;
            				
       				
                            //+++++++++++Education ++++++
                            $words = array(
		            			"শিক্ষা", "শিক্ষার্থী", "পাশ",
		            			"বৃত্তি", "কলেজ", "এস এস সি", "এইস এস সি", "ছাত্রী"
							);

		            		$education   = 0;
		            		foreach($words as $word) {
								$count   = substr_count($string, $word);
								$education = $education + $count;	
							}


 							//+++++++++++power++++++

                            $words = array("রাজনীতি", "রাজনিতি", "নেত্রী");

		            		$power   = 0;
		            		foreach($words as $word) {
								$total3 = substr_count($string, $word);
								$power = $power + $total3;	
							}


						    //+++++++++++job++++++
							$words = array("চাকুরি", "চাকুরী", "চাকরি", "চাকরী", "চাকরিজীবী", "ডাক্তার" , "শিক্ষিকা");

		            		$job    = 0;
		            		foreach($words as $word) {
								$total = substr_count($string, $word);
								$job = $job + $total;	
							}

								
                           
                            
                            //==========Database Update==========================

							Crawler::where('id', $newsCounter->id)->update([
								               'power' => $power,
								               'job' =>  $job,
								               'education' => $education,
								               
								        ]);

							//===================================================


							//Use the modulus operator to detect multiples of 10.
				             if ($i > 0 && $i % 10 == 0) {
				                   sleep(1);
				              }

            			}

		}











	  /**
	  *
	  *Define Final type for each women news 
	  */
	public function setType(){

		 set_time_limit(0);  //this will execute untill the job finished

		 $counter = Crawler::where('news_link', 'like', 'http://www.prothom-alo.com/bangladesh/article/%')
            					->get();


            			foreach ($counter as $i => $newsCounter) {

            				$string = $newsCounter->title;
            				
                           //bubble sort occurs

							if($sum != 0){
								  Crawler::where('id', $newsCounter->id)->update([
						               'type' =>  1,
						            ]);
							}else{

									
							}

							//Use the modulus operator to detect multiples of 10.
				             if ($i > 0 && $i % 10 == 0) {
				                   sleep(1);
				              }

            			}


	}









}
