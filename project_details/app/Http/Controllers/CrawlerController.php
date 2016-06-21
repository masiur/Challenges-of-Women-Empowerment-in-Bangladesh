<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Crawler;

class CrawlerController extends Controller
{


    public  function prothomAloLinks(){

        ini_set('MAX_EXECUTION_TIME', -1);

           for($page = 1; $page <= 5000 ; $page++) {
            //set url
            $url = "http://www.prothom-alo.com/bangladesh/article?page=" . $page;


            $client = new \GuzzleHttp\Client();
            $response = $client->get($url);
            $body = (string)$response->getBody();
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $body = mb_convert_encoding($body, 'HTML-ENTITIES', "UTF-8");
            $dom->loadHTML($body);
            libxml_clear_errors();
            $xpath = new \DOMXpath($dom);


            //Getting all data
             $table_rows = $xpath->query('//h2[@class="title"]/a/@href');


            $data = array();
             foreach ($table_rows as $row => $tr) {
                foreach ($tr->childNodes as $td) {
                    $data[$row][] = preg_replace('~[\r\n]+~', '', trim($td->nodeValue));
                 }
                $data[$row] = array_values(array_filter($data[$row]));


                 $crawl = new Crawler();
                 for ($j = 0; $j < count($data); $j++) {
                   $detail = 'http://www.prothom-alo.com/bangladesh/' . $data[$j][0];

                    // $check = Crawler::where('news_link', '=', $detail)
                      //  ->count();

               // if ($check == 0) {

                        $crawl->news_link = $detail;

                         try {
                            $crawl->save();
                        } catch (\Exception $e) {

                        }

                   // }


                }

           }

    }
}








public function prothomAloDetails()
{
     ini_set('MAX_EXECUTION_TIME', -1);

     $count = Crawler::where('news_link', 'like', 'http://www.prothom-alo.com/bangladesh/article/%')
            ->get();

        foreach ($count as $countNum) {

            $ch = curl_init($countNum->news_link);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $page = curl_exec($ch);

            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($page);
            libxml_clear_errors();
            $xpath = new \DOMXpath($dom);

            $data = array();

            $table_rows = $xpath->query('//h1[@class="title mb10"]|
                                           //div[@itemprop="articleBody"]|
                                           //div[@class="fl topic_list"]|
                                           //span[@itemprop="datePublished"]
                                           ');

            foreach ($table_rows as $row => $tr) {
                foreach ($tr->childNodes as $td) {
                    $data[$row][] = preg_replace('~[\r\n]+~', '', trim($td->nodeValue));
                }
                $data[$row] = array_values(array_filter($data[$row]));

            }




            //======================================================================================
            $banglaDate = $data[1][0];

            $search_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "জানুয়ারি", "ফেব্রুয়ারি", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট ", "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর", ":", ",");

            $replace_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", ":", ",");

            // convert all bangle char to English char
            $en_number = str_replace($search_array, $replace_array, $banglaDate);

            // remove unwanted char
            $end_date =  preg_replace('/[^A-Za-z0-9:\-]/', ' ', $en_number);

            // convert date
            $bangla_date = date("Y-m-d H:i ", strtotime($end_date));
           // echo $bangla_date;
            //======================================================================================

            Crawler::where('news_link', $countNum->news_link)->update([
                //'title' => $data[0][0],
                'details' => $data[2][0],
                'newspaper' => 'Prothom-Alo',
                'date' => $bangla_date,
                //'section' => $data[3],
            ]);

        // }

      } 
}















    public function all(){

        ini_set('MAX_EXECUTION_TIME', -1);

        for($a=1;$a<=4;$a++) {
            try {
                switch ($a) {
                    case 1:
                        $this->bangladeshWomenNews();
                        echo "complete<br/>";
                        break;
                    case 2:
                        $this->bangladeshWomenRapeNews();
                        echo "complete<br/>";
                        break;
                    case 3:
                        $this->bangladeshWomenStudentNews();
                        echo "complete<br/>";
                        break;
                    case 4:
                        $this->prothomAloDetails();
                        echo "complete<br/>";
                        break;

                    default:
                        echo "Something Wrong, Try Again<br/>";
                        break;
                }

            } catch (\Exception $e) {

            }
        }

    }














    /**
     *
     * Bangladesh all women news
     */
    public  function bangladeshWomenNews()
    {
        ini_set('MAX_EXECUTION_TIME', -1);
        //set url
        for($start=0, $end = $start+20; $end<5000 ; $start= $start+21, $end = $end+21 ) {

             $url = "http://www.prothom-alo.com/api/content_management/search/?start=".$start."&q=%E0%A6%A8%E0%A6%BE%E0%A6%B0%E0%A7%80&page_id=102&content=article&per_page=".$end;

            $client = new \GuzzleHttp\Client();
            $response = $client->get($url);
            $body = (string)$response->getBody();
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $body = mb_convert_encoding($body, 'HTML-ENTITIES', "UTF-8");
            $dom->loadHTML($body);
            libxml_clear_errors();
            $xpath = new \DOMXpath($dom);
            //Getting all data
            $table_rows = $xpath->query('//h3[@class !="subtitle"]/a/@href');
            $data = array();
            foreach ($table_rows as $row => $tr) {
                foreach ($tr->childNodes as $td) {
                    $data[$row][] = preg_replace('~[\r\n]+~', '', trim($td->nodeValue));
                }
                $data[$row] = array_values(array_filter($data[$row]));
                $crawl = new Crawler();
                for ($j = 0; $j < count($data); $j++) {
                    $detail = 'http://www.prothom-alo.com' . trim(stripslashes($data[$j][0]), '"');

                    //$check = Crawler::where('news_link', '=', $detail)
                       // ->count();

                   // if ($check == 0) {

                        $crawl->news_link = $detail;

                        try {
                            $crawl->save();
                        } catch (\Exception $e) {

                        }

                  //  }


                }

            }
        }
        //echo "Bangladesh women all news complete";

    }








    /**
     *
     * Bangladesh all women rape news
     */
    public  function bangladeshWomenRapeNews()
    {
        ini_set('MAX_EXECUTION_TIME', -1);
        //set url
        for($start=0, $end = $start+20; $end<1000 ; $start= $start+21, $end = $end+21 ) {

            $url = " http://www.prothom-alo.com/api/content_management/search/?start=".$start."&q=%E0%A6%A7%E0%A6%B0%E0%A7%8D%E0%A6%B7%E0%A6%A3+&page_id=102&content=article&per_page=".$end;


            $client = new \GuzzleHttp\Client();
            $response = $client->get($url);
            $body = (string)$response->getBody();
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $body = mb_convert_encoding($body, 'HTML-ENTITIES', "UTF-8");
            $dom->loadHTML($body);
            libxml_clear_errors();
            $xpath = new \DOMXpath($dom);
            //Getting all data
            $table_rows = $xpath->query('//h3[@class !="subtitle"]/a/@href');
            $data = array();
            foreach ($table_rows as $row => $tr) {
                foreach ($tr->childNodes as $td) {
                    $data[$row][] = preg_replace('~[\r\n]+~', '', trim($td->nodeValue));
                }
                $data[$row] = array_values(array_filter($data[$row]));
                $crawl = new Crawler();
                for ($j = 0; $j < count($data); $j++) {
                    $detail = 'http://www.prothom-alo.com' . trim(stripslashes($data[$j][0]), '"');

                    $check = Crawler::where('news_link', '=', $detail)
                        ->count();

                    if ($check == 0) {

                        $crawl->news_link = $detail;

                        try {
                            $crawl->save();
                        } catch (\Exception $e) {

                        }

                    }


                }

            }
        }
        //echo "Bangladesh women rape news complete";
    }




    /**
     *
     * Bangladesh girls student news
     */
    public  function bangladeshWomenStudentNews()
    {
        ini_set('MAX_EXECUTION_TIME', -1);
        //set url
        for($start=0, $end = $start+20; $end<1000 ; $start= $start+21, $end = $end+21 ) {

            $url = "http://www.prothom-alo.com/api/content_management/search/?start=".$start."&q=%E0%A6%9B%E0%A6%BE%E0%A6%A4%E0%A7%8D%E0%A6%B0%E0%A7%80&page_id=102&content=article&per_page=".$end;


            $client = new \GuzzleHttp\Client();
            $response = $client->get($url);
            $body = (string)$response->getBody();
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $body = mb_convert_encoding($body, 'HTML-ENTITIES', "UTF-8");
            $dom->loadHTML($body);
            libxml_clear_errors();
            $xpath = new \DOMXpath($dom);
            //Getting all data
            $table_rows = $xpath->query('//h3[@class !="subtitle"]/a/@href');
            $data = array();
            foreach ($table_rows as $row => $tr) {
                foreach ($tr->childNodes as $td) {
                    $data[$row][] = preg_replace('~[\r\n]+~', '', trim($td->nodeValue));
                }
                $data[$row] = array_values(array_filter($data[$row]));
                $crawl = new Crawler();
                for ($j = 0; $j < count($data); $j++) {
                    $detail = 'http://www.prothom-alo.com' . trim(stripslashes($data[$j][0]), '"');

                    $check = Crawler::where('news_link', '=', $detail)
                        ->count();

                    if ($check == 0) {

                        $crawl->news_link = $detail;

                        try {
                            $crawl->save();
                        } catch (\Exception $e) {

                        }

                    }


                }

            }
        }
      //  echo "Bangladesh girls student news complete";

    }








}
