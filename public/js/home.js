// import {Chart} from 'chart.js'

jQuery(document).ready(function($){
    // alert("Hello!")
    window.setInterval(function(){ // Set interval for checking
        var date = new Date(); // Create a Date object to find out what time it is
        if(date.getHours() === 8 && date.getMinutes() === 0){ // Check the time
            // Do stuff

        }
        alert('Refreshing');
    }, 60000); // Repeat every 60000 milliseconds (1 minute)

});
function getChart(){
    // e.preventDefaults();
    // alert('chart')
console.log(conductivityChart);

}
