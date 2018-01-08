<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<style>
#container {
	min-width: 310px;
	max-width: 800px;
	height: 400px;
	margin: 0 auto
}
</style>
<div id="container"></div>
<script type="text/javascript">
console.log("data=======>",localStorage.getItem('item'));
console.log("data=======>",typeof(localStorage.getItem('item')));
console.log("bps=======>",localStorage.getItem('bps'));
console.log("bpd=======>",localStorage.getItem('bpd'));
console.log("----jsond",(localStorage.getItem('bps')).replace(/"/g, ""));
console.log(JSON.parse(localStorage.getItem('bpd')).map(Number));
var grid=JSON.parse(localStorage.getItem('bps')).map(Number);
console.log(" grid",grid[0]);
Highcharts.chart('container', {

    title: {
        text: 'Gia Barclay'
    },

    subtitle: {
        text: ''
    },

    yAxis: {
        title: {
            text: ''
        }
    },
     xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            //pointStart: 1
        }
    },

    series: [{
        name: 'Systolic',
        data: JSON.parse(localStorage.getItem('bps')).map(Number)
    }, {
        name: 'Diastolic',
        data: JSON.parse(localStorage.getItem('bpd')).map(Number)
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
</script>
<?php 

    
    
    

                 
 ?>
   <script type="text/javascript">
   localStorage.setItem("vital",'<?php print_r($_POST['obj']);?>');
</script>

