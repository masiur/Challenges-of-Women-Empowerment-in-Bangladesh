@extends('layouts.default')
    @section('content')
   
        <h1>Women Condition Prediction</h1>




    <div class="row">
        {{--renter graph--}}
        <br/><br/>



       <div class="col-md-6">
                <div class="portlet"><!-- /primary heading -->
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark">
                             All Good Nwes And Bad News Classification (Radar)
                        </h3>
                        <div class="portlet-widgets">
                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet1" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <canvas id="chart1" width="600" height="300" ></canvas>
                        </div>
                    </div>
                </div>
            </div>


			<!-- 
			<div class="col-md-6">
                <div class="portlet">
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark">
                             chart 
                        </h3>
                        <div class="portlet-widgets">
                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet1" class="panel-collapse collapse in">
                        <div class="portlet-body">
                           <canvas id="skills" width="600" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
			 -->
		

        
      <div class="col-md-6">
                <div class="portlet">
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark">
                           All Good Nwes And Bad News Classification (Bar)
                        </h3>
                        <div class="portlet-widgets">
                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet1" class="panel-collapse collapse in">
                        <div class="portlet-body">
                          <canvas id="chart2" width="600" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
      
    

            <div class="col-md-6">
                <div class="portlet">
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark">
                             Good News And Bad News  
                        </h3>
                        <div class="portlet-widgets">
                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet1" class="panel-collapse collapse in">
                        <div class="portlet-body">
                          <canvas id="chart3" width="600" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
      
    
      
			
			<div class="col-md-6">
                <div class="portlet">
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark">
                             Women News From all News   
                        </h3>
                        <div class="portlet-widgets">
                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet1" class="panel-collapse collapse in">
                        <div class="portlet-body">
                          <canvas id="chart4" width="600" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>




            <div class="col-md-6">
                <div class="portlet">
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark">
                             All Bad News Classification
                        </h3>
                        <div class="portlet-widgets">
                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet1" class="panel-collapse collapse in">
                        <div class="portlet-body">
                          <canvas id="chart5" width="600" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-6">
                <div class="portlet">
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark">
                              All Good News Classification
                        </h3>
                        <div class="portlet-widgets">
                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet1" class="panel-collapse collapse in">
                        <div class="portlet-body">
                          <canvas id="chart6" width="600" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
		

         



    </div> <!-- end row -->

@stop




@section('style')
@stop


@section('script')
   
     {!! Html::script('assets/chartjs/chart.min.js') !!}
     {!! Html::script('assets/chartjs/chartjs.init.js') !!}

    <script type="text/javascript">



	(function() {
		var ctx = document.getElementById('chart1').getContext("2d");
		var chart = {
			labels: {!! json_encode($type_group) !!},
			datasets: [{
				data: {!!   json_encode($news_group) !!},
				fillColor : "#1B95A9",
				strokeColor : "#03525F",
				pointColor : "#6C0842"
			}]
		};
		new Chart(ctx).Radar(chart, { bezierCurve: false });
	})();  



// 	
  (function() {
    var ctxi = document.getElementById('chart2').getContext("2d");
    var chart2 = {
      labels: {!! json_encode($type_group) !!},
      datasets: [{
        data: {!!   json_encode($news_group) !!},
        fillColor : "#1B95A9",
        strokeColor : "#03525F",
        pointColor : "#6C0842"
      }]
    };
    new Chart(ctxi).Bar(chart2, { bezierCurve: false });
  })();  



//women good news and bad news 
(function() {
    var ctxL = document.getElementById('chart3').getContext("2d");
    var chart3 = {
      labels: ["Women Good News", "Women Bad News"],
      datasets: [{
        data: {!!   json_encode($good_bad) !!},
        fillColor : "#1B95A9",
        strokeColor : "#03525F",
        pointColor : "#6C0842"
      }]
    };
    new Chart(ctxL).Radar(chart3, { bezierCurve: false });
  })();  



//women news from all news 
(function() {
    var ctxW = document.getElementById('chart4').getContext("2d");
    var chart4 = {
      labels: ["Other News", "Women News"],
      datasets: [{
        data: {!!   json_encode($women_news) !!},
        fillColor : "#1B95A9",
        strokeColor : "#03525F",
        pointColor : "#6C0842"
      }]
    };
    new Chart(ctxW).Radar(chart4, { bezierCurve: false });
  })();  




//good news classification
  (function() {
    var ctxG = document.getElementById('chart6').getContext("2d");
    var chart6 = {
      labels: {!! json_encode($good_news_label) !!},
      datasets: [{
        data: {!!   json_encode($good_news_value) !!},
        fillColor : "#1B95A9",
        strokeColor : "#03525F",
        pointColor : "#6C0842"
      }]
    };
    new Chart(ctxG).Bar(chart6, { bezierCurve: false });
  })();  


//bad news classification
  (function() {
    var ctxB = document.getElementById('chart5').getContext("2d");
    var chart5 = {
      labels: {!! json_encode($bad_news_label) !!},
      datasets: [{
        data: {!!   json_encode($bad_news_value) !!},
        fillColor : "#1B95A9",
        strokeColor : "#03525F",
        pointColor : "#6C0842"
      }]
    };
    new Chart(ctxB).Line(chart5, { bezierCurve: false });
  })();  




	
var pieData = {!! $good_news !!}
var context = document.getElementById('skills').getContext('2d');
var skillsChart = new Chart(context).Pie (pieData);






	</script>
@stop