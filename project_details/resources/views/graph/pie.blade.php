
      

      





  {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.min.js') !!}

    <script>
      var ctx = document.getElementById("myChart");
      var data = {
        labels:  {!! json_encode($pie_group_type) !!},
        datasets: [
            {
                labels:  {!! json_encode($pie_group_type) !!},
                data:  {!! json_encode($pie_group_news) !!},
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


