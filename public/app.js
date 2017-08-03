$( document ).ready(function () {
    var btn = $("#btn-formula");

    var type = 'column';
    var title = 'Forecast Cursos Academia';
    var categories = ['Venta Real', 'Venta Proyectada'];
    var ytext = 'Fruit eaten';

     $(function () {
        var myChart = Highcharts.chart('container', {
            chart: {
                type: type
            },
            title: {
                text: title
            },
            xAxis: {
                categories: categories
            },
            yAxis: {
                title: {
                    text: ytext
                }
            },
            series: [{
                name: 'Jane',
                data: [1, 0, 4]
            }, {
                name: 'John',
                data: [5, 7, 3]
            }]
        });
    });


    btn.click(function () {
        var formula = $("#input-formula").val();
        var url = "formulario.php";
        $.getJSON(url, {'formula' : formula})
            .done(function (data) {
                console.log('data');
            });
    });

});