
// import { Chart, LineController, LineElement, PointElement, LinearScale, Title } from 'chart.js'

// Chart.register(LineController, LineElement, PointElement, LinearScale, Title);

jQuery(document).ready(function($){
    // alert("Hello!")
    window.setInterval(function(){ // Set interval for checking
        var date = new Date(); // Create a Date object to find out what time it is
        if(date.getHours() === 8 && date.getMinutes() === 0){ // Check the time
            // Do stuff

        }
        console.log('Refreshing with new data');
        $('.fa-sync-alt').animate(
            { deg: 360 },
            {
              duration: 1200,
              step: function(now) {
                $(this).css({ transform: 'rotate(' + now + 'deg)' });
              }
            }
          );
    }, 60000); // Repeat every 60000 milliseconds (1 minute) * 5


});
$('#conductivity_chart').on('click', function(){
    console.log('conductivity-------')
    var data_labels = ['12:10', '12:11', '12:12', '12:13', '12:14', '12:15'];
    var ctx_conductivity = document.getElementById('conductivityChart').getContext('2d');
    var conductivityChart = new Chart(ctx_conductivity, {
        type: 'bar',
        data: {
            labels: data_labels,
            datasets: [{
                // label: ['Good','OK','Poor'],
                data: [3.5, 4.0, 10.5, 12.3, 5.2, 5.3],
                backgroundColor: [
                    'green',
                    'green',
                    'red',
                    'red',
                    'orange',
                    'orange'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});

$('#volume_chart').on('click', function(){
    // e.preventDefault();
    console.log('voluem......')
    var ctx_volume = document.getElementById('volumeChart').getContext('2d');
    var volumeChart = new Chart(ctx_volume, {
        type: 'line',
        data: {
            labels: [1,2,3,4,5,],
            datasets: [{
                label: 'Pure',
                data: [300, 50, 100, 240, 22],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            },{
                label: 'Waste',
                data: [100, 150, 110, 210, 212],
                fill: false,
                borderColor: 'rgb(75, 44, 120)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            interaction: {
                // Overrides the global setting
                mode: 'index'
            },
            plugins: {
                title: {
                    display: true,
                    text: '5 Hours Pure Waste Comparision',
                    position: 'top',
                    padding: {
                        top: 10,
                        bottom: 30
                    }
                }
            }
        }
    });
});

