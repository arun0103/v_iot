
// import { Chart, LineController, LineElement, PointElement, LinearScale, Title } from 'chart.js'

//const { default: Swal } = require("sweetalert2");

// Chart.register(LineController, LineElement, PointElement, LinearScale, Title);

jQuery(document).ready(function($){
    // alert("Hello!")
    window.setInterval(function(){ // Set interval for checking
        // var date = new Date(); // Create a Date object to find out what time it is
        // if(date.getHours() === 8 && date.getMinutes() === 0){ // Check the time
        //     // Do stuff

        // }
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
    $(document).on('click', '.sidebar-toggle', function () {
        if ($('body').hasClass("sidebar-collapse") && $('body').hasClass("sidebar-open")) {
           $('body').removeClass("sidebar-collapse");
        }
    });


});
// $('#conductivity_chart').on('click', function(){
//     console.log('conductivity-------')
//     var data_labels = ['12:10', '12:11', '12:12', '12:13', '12:14', '12:15','12:10', '12:11', '12:12', '12:13', '12:14', '12:15','12:10', '12:11', '12:12', '12:13', '12:14', '12:15','12:10', '12:11', '12:12', '12:13', '12:14', '12:15','12:10', '12:11', '12:12', '12:13', '12:14', '12:15','12:10', '12:11', '12:12', '12:13', '12:14', '12:15'];
//     var ctx_conductivity = document.getElementById('conductivityChart').getContext('2d');
//     var conductivityChart = new Chart(ctx_conductivity, {
//         type: 'bar',
//         data: {
//             labels: data_labels,
//             datasets: [{
//                 // label: ['Good','OK','Poor'],
//                 data: [3.5, 4.0, 10.5, 12.3, 5.2, 5.3,3.5, 4.0, 10.5, 12.3, 5.2, 5.3,3.5, 4.0, 10.5, 12.3, 5.2, 5.3,3.5, 4.0, 10.5, 12.3, 5.2, 5.3,3.5, 4.0, 10.5, 12.3, 5.2, 5.3,3.5, 4.0, 10.5, 12.3, 5.2, 5.3],
//                 backgroundColor: [
//                     'green',
//                     'green',
//                     'red',
//                     'red',
//                     'orange',
//                     'orange',
//                     'green',
//                     'green',
//                     'red',
//                     'red',
//                     'orange',
//                     'orange',
//                     'green',
//                     'green',
//                     'red',
//                     'red',
//                     'orange',
//                     'orange',
//                     'green',
//                     'green',
//                     'red',
//                     'red',
//                     'orange',
//                     'orange',
//                     'green',
//                     'green',
//                     'red',
//                     'red',
//                     'orange',
//                     'orange',
//                     'green',
//                     'green',
//                     'red',
//                     'red',
//                     'orange',
//                     'orange'
//                 ],
//                 borderColor: [
//                     'rgba(255, 99, 132, 1)',
//                     'rgba(54, 162, 235, 1)',
//                     'rgba(255, 206, 86, 1)',
//                     'rgba(75, 192, 192, 1)',
//                     'rgba(153, 102, 255, 1)',
//                     'rgba(255, 159, 64, 1)',
//                     'rgba(255, 99, 132, 1)',
//                     'rgba(54, 162, 235, 1)',
//                     'rgba(255, 206, 86, 1)',
//                     'rgba(75, 192, 192, 1)',
//                     'rgba(153, 102, 255, 1)',
//                     'rgba(255, 159, 64, 1)',
//                     'rgba(255, 99, 132, 1)',
//                     'rgba(54, 162, 235, 1)',
//                     'rgba(255, 206, 86, 1)',
//                     'rgba(75, 192, 192, 1)',
//                     'rgba(153, 102, 255, 1)',
//                     'rgba(255, 159, 64, 1)',
//                     'rgba(255, 99, 132, 1)',
//                     'rgba(54, 162, 235, 1)',
//                     'rgba(255, 206, 86, 1)',
//                     'rgba(75, 192, 192, 1)',
//                     'rgba(153, 102, 255, 1)',
//                     'rgba(255, 159, 64, 1)',
//                     'rgba(255, 99, 132, 1)',
//                     'rgba(54, 162, 235, 1)',
//                     'rgba(255, 206, 86, 1)',
//                     'rgba(75, 192, 192, 1)',
//                     'rgba(153, 102, 255, 1)',
//                     'rgba(255, 159, 64, 1)',
//                     'rgba(255, 99, 132, 1)',
//                     'rgba(54, 162, 235, 1)',
//                     'rgba(255, 206, 86, 1)',
//                     'rgba(75, 192, 192, 1)',
//                     'rgba(153, 102, 255, 1)',
//                     'rgba(255, 159, 64, 1)'
//                 ],
//                 borderWidth: 1
//             }]
//         },
//         options: {
//             scales: {
//                 y: {
//                     beginAtZero: true
//                 }
//             }
//         }
//     });
// });
var graph_time_frame, graph_custom_from, graph_custom_to;
var graph_title, graph_labels, graph_x_label, graph_y_label, graph_data;
var graph_displayed = "none";
var volumeChart;
$('#timeframe_volume').on('change', function(){
    graph_time_frame = $('#timeframe_volume').val();
    if(graph_time_frame != graph_displayed)
        $('#btn_reload_graph').prop('disabled', false);
    else
        $('#btn_reload_graph').prop('disabled', true);
    switch(graph_time_frame){
        case 'custom':
            $('.volume_custom_time').show();
            graph_title = "Water purified in "+ graph_custom_from + " to "+ graph_custom_to;
            break;
        case 'last_hour':
            $('.volume_custom_time').hide();
            graph_title = "Water purified in Last Hour";
            break;
        case 'last_24_hour':
            graph_title = "Water purified in Last 24 Hours";
            $('.volume_custom_time').hide();

            break;
    }
    // volumeChart.update();
    $('#btn_reload_graph').show();
})
$('#btn_reload_graph').on('click', function(){
    //alert('reloading')
    var ctx_volume = document.getElementById('volumeChart').getContext('2d');
    switch(graph_time_frame){
        case 'custom':
            graph_custom_from = $('#inputFromDate_volume').val();
            graph_custom_to = $('#inputToDate_volume').val();
            //fetch data from server
            graph_labels = ['01:00','02:00','03:00','04:00','05:00','01:00','02:00','03:00','04:00','05:00','01:00','02:00','03:00','04:00','05:00'];
            graph_data = [12,10,5,20,25,12,10,5,20,25,12,10,5,20,25];
            graph_displayed = "custom";
            break;
        case 'last_hour':
            $('.volume_custom_time').hide();
            //fetch data from server
            graph_labels = ['01:00','02:00','03:00','04:00','05:00'];
            graph_data = [12,10,5,20,25];
            graph_displayed = "last_hour";
            break;
        case 'last_24_hour':
            $('.volume_custom_time').hide();
            //fetch data from server
            graph_labels = ['01:00','02:00','03:00','04:00','05:00','01:00','02:00','03:00','04:00','05:00'];
            graph_data = [12,10,5,20,25,12,10,5,20,25];
            graph_displayed = "last_24_hr";
            break;
    }
    if(volumeChart){
        volumeChart.destroy();
    }
    volumeChart = new Chart(ctx_volume, {
        type: 'bar',
        data: {
            labels: graph_labels,
            datasets: [{
                label: 'Volume purified',
                position: 'right',
                data: graph_data,
                fill: true,
                backgroundColor: 'cyan',
                borderColor: 'blue',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            interaction: {
                // Overrides the global setting
                mode: 'index'
            },
            title: {
                display: true,
                text: graph_title,
                position: 'top',
                // padding: {
                //     top: 10,
                //     bottom: 30
                // }
            },
            scales: {
                xAxes:[{
                    scaleLabel: {
                        display: true,
                        labelString: "Time (HH::MM)"
                    }
                }],
                yAxes:[{
                    scaleLabel: {
                        display: true,
                        labelString: "Value (in gallons)"
                    }
                }]
            }
        }
    });
    $('#volumeChart').show();
    $('#btn_reload_graph').prop('disabled', true);

})
$('#btn_download_pdf_graph').on('click', function() {
    // get size of report page
    var reportPageHeight = $('#div_report').innerHeight();
    var reportPageWidth = $('#div_report').innerWidth();

    // create a new canvas object that we will populate with all other canvas objects
    var pdfCanvas = $('<canvas />').attr({
        id: "canvaspdf",
        width: reportPageWidth,
        height: reportPageHeight
    });

    // keep track canvas position
    var pdfctx = $(pdfCanvas)[0].getContext('2d');
    var pdfctxX = 0;
    var pdfctxY = 0;
    var buffer = 100;

    // for each chart.js chart
    $("canvas").each(function(index) {
        // get the chart height/width
        var canvasHeight = $(this).innerHeight();
        var canvasWidth = $(this).innerWidth();

        // draw the chart into the new canvas
        pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
        pdfctxX += canvasWidth + buffer;

        // our report page is in a grid pattern so replicate that in the new canvas
        if (index % 2 === 1) {
        pdfctxX = 0;
        pdfctxY += canvasHeight + buffer;
        }
    });

    // create new pdf and add our new canvas as an image
    var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
    pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);

    // download the pdf
    pdf.save('filename.pdf');
});

$('tr a.link_view_users' ).on('click', function() {
    var trid = $(this).closest('tr').attr('id'); // table row ID
    console.log(trid)
  });
$('.btn_device_start_stop').on('click', function(){
    var trid = $(this).closest('tr').attr('id'); // table row ID
    switch($('#btn_device_start_stop-'+trid).text()){
        case "Stop":
            command_sent = "Stop";
            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "POST",
                url: "/command/stop/"+ trid,
            })
            .done(function(response){
                console.log(response);
                Swal.fire('Success','Command recorded.','success')
                start_stop_command_sent = true;
                // $('#device_status-'+trid).text('IDLE')
                document.getElementById('device_status-'+trid).style.color = 'orange'
                document.getElementById('device_status_pic-'+trid).style.color = 'orange'
                $('#btn_device_start_stop-'+trid).text('Stopping')
                $('#btn_device_start_stop-'+trid).removeClass('btn-danger').addClass('btn-primary')
                $('#btn_device_start_stop-'+trid).attr('disabled','true');
                // var date = new Date(response.created_at)
                // $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
            });
            break;
        case "Start":
            command_sent = "Start";
            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "POST",
                url: "/command/start/"+ trid,
            })
            .done(function(response){
                console.log(response);
                Swal.fire('Success','Command recorded.','success')
                start_stop_command_sent[trid] = true;
                // $('#device_status-'+trid).text('RUNNING')
                document.getElementById('device_status-'+trid).style.color = 'green'
                document.getElementById('device_status_pic-'+trid).style.color = 'green'
                $('#btn_device_start_stop-'+trid).text('Starting')
                $('#btn_device_start_stop-'+trid).removeClass('btn-primary').addClass('btn-danger')
                $('#btn_device_start_stop-'+trid).attr('disabled','true');
                // var date = new Date(response.created_at)
                // $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
            });
            break;
    }

})
///////////////////////////////////////////////////////////////////////////////
///////////////// info button clicks //////////////////////////


$('.info-device-status').on('click', function(){
    console.log("hi")
    var trid = $(this).closest('tr').attr('id'); // table row ID
    console.log(trid)
    switch($('#device_status-'+trid).text()){
        case 'RUNNING':
            $('#info_device_status_text-'+trid).text("Running")
            $('#info_device_status_description-'+trid).text('')
            $('#info_device_status_description-'+trid).append("<b>(Don’t Worry)</b> Device is running and treating water ")
            break;
        case 'IDLE':
            $('#info_device_status_text-'+trid).text("Idle")
            $('#info_device_status_description-'+trid).text('')
            $('#info_device_status_description-'+trid).append("<b>(Oops!!!)</b> Device is not operational. It requires user intervention.")
            break;
        case 'Pending':
            $('#info_device_status_text-'+trid).text("Pending")
            $('#info_device_status_description-'+trid).text('')
            $('#info_device_status_description-'+trid).append("<b>(Please Wait!!!)</b> Connecting with the device..")
            break;
    }
})
$('.info-device-connection').on('click', function(){
    var trid = $(this).closest('tr').attr('id'); // table row ID
    switch($('#device_connection_status-'+trid).text()){
        case 'Connected':
            $('#info_device_connection_text-'+trid).text('Connected')
            //alert($('#info_device_connection_text').text())
            $('#info_device_connection_description-'+trid).text('')
            $('#info_device_connection_description-'+trid).append("<b>Awesome!!!</b> Device is connected to the Internet ")
            break;
        default:
            $('#info_device_connection_text-'+trid).text('Disconnected')
            //alert($('#info_device_connection_text').text())
            $('#info_device_connection_description-'+trid).text('')
            $('#info_device_connection_description-'+trid).append("<b>Oops!!!</b> Device is not connected!")

    }
})
$('.info_device_health').on('click', function(){
    var trid = $(this).closest('tr').attr('id'); // table row ID
    switch($('#device_health_status-'+trid).text()){
        case 'Good':
            $('#info_device_health_text-'+trid).text("Good")
            $('#info_device_health_description-'+trid).text('')
            $('#info_device_health_description-'+trid).append("<b>Great!!!</b> Device is in good condition! ")
            break;
        case 'Idle':
            $('#info_device_health_text-'+trid).text("Idle")
            $('#info_device_health_description-'+trid).text('')
            $('#info_device_health_description-'+trid).append("<b>(Oops!!!)</b> Device is not operational. It requires user intervention.")
            break;
    }
})

$('.info_device_conductivity').on('click', function(){
    var trid = $(this).closest('tr').attr('id'); // table row ID
    switch($('#device_conductivity_value-'+trid).text()){
        case "On Target":
            $('#info_device_conductivity_text-'+trid).text("On Target")
            $('#info_device_conductivity_text-'+trid).css("color","green")
            $('#info_device_conductivity_description-'+trid).text('')
            $('#info_device_conductivity_description-'+trid).append("The unit is removing the right amount of minerals.")
            break;
        case "Needs Attention":
            $('#info_device_conductivity_text-'+trid).text("Needs Attention")
            $('#info_device_conductivity_text-'+trid).css("color","red")
            $('#info_device_conductivity_description-'+trid).text('')
            $('#info_device_conductivity_description-'+trid).append("The unit is removing most of the minerals. ")
            break;
        case "No Data":
            $('#info_device_conductivity_text-'+trid).text("No Data")
            $('#info_device_conductivity_text-'+trid).css("color","orange")
            $('#info_device_conductivity_description-'+trid).text('')
            $('#info_device_conductivity_description-'+trid).append("Device is not sending data. Please Check the internet connection")
            break;
    }
})
/// ---------------------------------------------------------------------
// $('.modal-volume-chart').on('click', function(){
//     var trid = $(this).closest('tr').attr('id'); // table row ID

// })
