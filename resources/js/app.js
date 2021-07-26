/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: axios } = require('axios');

require('./bootstrap');


//jQuery
import $ from 'jquery';
window.$ = window.jQuery = $;
import 'jquery-ui/ui/widgets/datepicker.js';
import 'datatables.net/js/jquery.dataTables.js';

var dt = require( 'datatables.net' );
require('select2');

$('.datepicker').datepicker();
$('.datatable').DataTable();

//jsPDF
const { jsPDF } = require("jspdf"); // will automatically load the node version


import Swal from 'sweetalert2'       // sweet alert 2 ES6 Modules or TypeScript
//window.Swal = swal;

const {default:Swal} = require('sweetalert2')   // CommonJS


window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('users_list', require('./components/UsersList.vue').default);
// Vue.component('user_profile', require('./components/UsersProfile.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 const app = new Vue({
    el: '#app'
});

// const app_user = new Vue({
//     el: '#app_users',
//     data:{
//         users_list:[],
//         user_devices:[],
//     },


//     mounted(){
//         console.log('Component mounted.')
//             axios.get('/api/getUsers').then((response)=>{
//                 this.users_list = response.data;
//                 console.log(this.users_list);
//                 console.log(this.users_list[0].name)
//             })
//             .catch(error=>{
//                 console.log(error.message)
//             })
//     }
// });
// var Chart = require('chart.js');
import {Chart,ArcElement,LineElement,BarElement,PointElement,
        BarController,BubbleController,DoughnutController,LineController,PieController,PolarAreaController,RadarController,ScatterController,
        CategoryScale,LinearScale,LogarithmicScale,RadialLinearScale,TimeScale,TimeSeriesScale,
        Decimation,Filler,Legend,Title,Tooltip } from 'chart.js';

Chart.register(ArcElement,LineElement,BarElement,PointElement,
        BarController,BubbleController,DoughnutController,LineController,PieController,PolarAreaController,RadarController,ScatterController,
        CategoryScale,LinearScale,LogarithmicScale,RadialLinearScale,TimeScale,TimeSeriesScale,
        Decimation,Filler,Legend,Title,Tooltip  );

// jQuery(document).ready(function($){
//     var ctx = document.getElementById('volumeChart').getContext('2d');
//     var myChart = new Chart(ctx, {
//         type: 'line',
//         data: {
//             labels: [1,2,3,4,5,],
//             datasets: [{
//                 label: 'Pure',
//                 data: [300, 50, 100, 240, 22],
//                 fill: false,
//                 borderColor: 'rgb(75, 192, 192)',
//                 tension: 0.1
//             },{
//                 label: 'Waste',
//                 data: [100, 150, 110, 210, 212],
//                 fill: false,
//                 borderColor: 'rgb(75, 44, 120)',
//                 tension: 0.1
//             }]
//         },
//         options: {
//             responsive: true,
//             interaction: {
//                 // Overrides the global setting
//                 mode: 'index'
//             },
//             plugins: {
//                 title: {
//                     display: true,
//                     text: '5 Hours Pure Waste Comparision',
//                     position: 'top',
//                     padding: {
//                         top: 10,
//                         bottom: 30
//                     }
//                 }
//             }
//         }
//     });

//     var ctx = document.getElementById('myChart').getContext('2d');
//     var myChart = new Chart(ctx, {
//         type: 'bar',
//         data: {
//             labels: ['12:10', '12:11', '12:12', '12:13', '12:14', '12:15'],
//             datasets: [{
//                 label: 'Conductivity',
//                 data: [3.5, 4.0, 10.5, 12.3, 5.2, 5.3],
//                 backgroundColor: [
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

