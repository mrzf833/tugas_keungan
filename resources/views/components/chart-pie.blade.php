<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Pie Chart Example
    var ctx = document.getElementById("{{ $id_chart_pie }}");
    var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: {{ $label }},
        datasets: [{
        data: {{ $data }},
        backgroundColor: {{ $bg_color }},
        hoverBackgroundColor: {{ $hover_bg_color }},
        hoverBorderColor: '{{ $hover_border_color ??  "rgba(234, 236, 244, 1)" }}',
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
            label: function(tooltipItem, chart) {
            var datasetLabel = chart.labels[tooltipItem.index] || '';
            return datasetLabel + ': RP. ' + number_format(chart.datasets[0].data[tooltipItem.index]);
            }
        }
        },
        legend: {
        display: false
        },
        cutoutPercentage: 80,
    },
    });
</script>