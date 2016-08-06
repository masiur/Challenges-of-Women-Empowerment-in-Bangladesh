@extends('layouts.default')
    @section('content')
   
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
                            <canvas id="myChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>

       </div>
@stop




@section('script')

      {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.min.js') !!}

    <script>
      var ctx = document.getElementById("myChart");
      var data = {
        labels:  {!! json_encode($type_group) !!},
        datasets: [
            {
                labels:  {!! json_encode($type_group) !!},
                data:  {!! json_encode($news_group) !!},
                backgroundColor: [
                    "#FF6384",
                    "#36A2EB",
                    "#FFCE56",
                    "#D7BDE2",
                    "#C0392B",
                    "#2E4053",
                    "#4A235A",
                    "#A9CCE3",
                    "#D4AC0D",
                    
                ],
                hoverBackgroundColor: [
                    "#C0392B",
                   
                ],

            }]
    };




      var myPieChart = new Chart(ctx,{
        type: 'pie',
        data: data,
          options: {
                  responsive: false,
                  legend: {
                    position: 'bottom',
                  },
                  title: {
                    display: false,
                    text: 'Chart.js Doughnut Chart'
                  },
                  animation: {
                    animateScale: true,
                    animateRotate: true
                  },
                  tooltips: {
                    callbacks: {
                      label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                          return previousValue + currentValue;
                        });

                         var currentLabel = dataset.labels[tooltipItem.index];   //getting lebel
                         var currentValue = dataset.data[tooltipItem.index]; //getting value
                         var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
                        return  currentLabel +" : " + precentage + "%";
                      }
                    }
                  }
           }
      });
</script>


@stop