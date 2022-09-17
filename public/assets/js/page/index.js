"use strict";

var ctx = document.getElementById("myChart").getContext("2d");
var myChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
        ],
        datasets: [
            {
                label: "Sales",
                data: [3200, 1800, 4305, 3022, 6310, 5120, 5880, 6154],
                borderWidth: 2,
                backgroundColor: "rgba(63,82,227,.8)",
                borderWidth: 0,
                borderColor: "transparent",
                pointBorderWidth: 0,
                pointRadius: 3.5,
                pointBackgroundColor: "transparent",
                pointHoverBackgroundColor: "rgba(63,82,227,.8)",
            },
            {
                label: "Budget",
                data: [2207, 3403, 2200, 5025, 2302, 4208, 3880, 4880],
                borderWidth: 2,
                backgroundColor: "rgba(254,86,83,.7)",
                borderWidth: 0,
                borderColor: "transparent",
                pointBorderWidth: 0,
                pointRadius: 3.5,
                pointBackgroundColor: "transparent",
                pointHoverBackgroundColor: "rgba(254,86,83,.8)",
            },
        ],
    },
    options: {
        legend: {
            display: false,
        },
        scales: {
            yAxes: [
                {
                    gridLines: {
                        // display: false,
                        drawBorder: false,
                        color: "#f2f2f2",
                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1500,
                        callback: function (value, index, values) {
                            return "$" + value;
                        },
                    },
                },
            ],
            xAxes: [
                {
                    gridLines: {
                        display: false,
                        tickMarkLength: 15,
                    },
                },
            ],
        },
    },
});

var balance_chart = document.getElementById("balance-chart").getContext("2d");

var balance_chart_bg_color = balance_chart.createLinearGradient(0, 0, 0, 70);
balance_chart_bg_color.addColorStop(0, "rgba(63,82,227,.2)");
balance_chart_bg_color.addColorStop(1, "rgba(63,82,227,0)");

var myChart = new Chart(balance_chart, {
    // type: "bar",
    // data: {
    //     labels: [
    //         "16-07-2018",
    //         "17-07-2018",
    //         "18-07-2018",
    //         "19-07-2018",
    //         "20-07-2018",
    //         "21-07-2018",
    //         "22-07-2018",
    //         "23-07-2018",
    //         "24-07-2018",
    //         "25-07-2018",
    //         "26-07-2018",
    //         "27-07-2018",
    //         "28-07-2018",
    //         "29-07-2018",
    //         "30-07-2018",
    //         "31-07-2018",
    //     ],
    //     datasets: [
    //         {
    //             label: "Balance",
    //             data: [
    //                 50, 61, 80, 50, 72, 52, 60, 41, 30, 45, 70, 40, 93, 63, 50,
    //                 62,
    //             ],
    //             backgroundColor: balance_chart_bg_color,
    //             borderWidth: 3,
    //             borderColor: "rgba(63,82,227,1)",
    //             pointBorderWidth: 0,
    //             pointBorderColor: "transparent",
    //             pointRadius: 3,
    //             pointBackgroundColor: "transparent",
    //             pointHoverBackgroundColor: "rgba(63,82,227,1)",
    //         },
    //     ],
    // },
    // options: {
    //     layout: {
    //         padding: {
    //             bottom: -1,
    //             left: -1,
    //         },
    //     },
    //     legend: {
    //         display: false,
    //     },
    //     scales: {
    //         yAxes: [
    //             {
    //                 gridLines: {
    //                     display: false,
    //                     drawBorder: false,
    //                 },
    //                 ticks: {
    //                     beginAtZero: true,
    //                     display: false,
    //                 },
    //             },
    //         ],
    //         xAxes: [
    //             {
    //                 gridLines: {
    //                     drawBorder: false,
    //                     display: false,
    //                 },
    //                 ticks: {
    //                     display: false,
    //                 },
    //             },
    //         ],
    //     },
    // },
    type: "bar",
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [
            {
                label: "# of Votes",
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    "rgba(255, 99, 132, 0.2)",
                    "rgba(54, 162, 235, 0.2)",
                    "rgba(255, 206, 86, 0.2)",
                    "rgba(75, 192, 192, 0.2)",
                    "rgba(153, 102, 255, 0.2)",
                    "rgba(255, 159, 64, 0.2)",
                ],
                borderColor: [
                    "rgba(255,99,132,1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(153, 102, 255, 1)",
                    "rgba(255, 159, 64, 1)",
                ],
                borderWidth: 1,
            },
        ],
    },
    options: {
        scales: {
            yAxes: [
                {
                    ticks: {
                        beginAtZero: true,
                    },
                },
            ],
        },
    },
});

var sales_chart = document.getElementById("sales-chart").getContext("2d");

var sales_chart_bg_color = sales_chart.createLinearGradient(0, 0, 0, 80);
balance_chart_bg_color.addColorStop(0, "rgba(63,82,227,.2)");
balance_chart_bg_color.addColorStop(1, "rgba(63,82,227,0)");

var myChart = new Chart(sales_chart, {
    type: "bar",
    data: {
        labels: [
            "16-07-2018",
            "17-07-2018",
            "18-07-2018",
            "19-07-2018",
            "20-07-2018",
            "21-07-2018",
            "22-07-2018",
            "23-07-2018",
            "24-07-2018",
            "25-07-2018",
            "26-07-2018",
            "27-07-2018",
            "28-07-2018",
            "29-07-2018",
            "30-07-2018",
            "31-07-2018",
        ],
        datasets: [
            {
                label: "Sales",
                data: [
                    70, 62, 44, 40, 21, 63, 82, 52, 50, 31, 70, 50, 91, 63, 51,
                    60,
                ],
                borderWidth: 2,
                backgroundColor: balance_chart_bg_color,
                borderWidth: 3,
                borderColor: "rgba(63,82,227,1)",
                pointBorderWidth: 0,
                pointBorderColor: "transparent",
                pointRadius: 3,
                pointBackgroundColor: "transparent",
                pointHoverBackgroundColor: "rgba(63,82,227,1)",
            },
        ],
    },
    options: {
        layout: {
            padding: {
                bottom: -1,
                left: -1,
            },
        },
        legend: {
            display: false,
        },
        scales: {
            yAxes: [
                {
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        beginAtZero: true,
                        display: false,
                    },
                },
            ],
            xAxes: [
                {
                    gridLines: {
                        drawBorder: false,
                        display: false,
                    },
                    ticks: {
                        display: false,
                    },
                },
            ],
        },
    },
});

$("#products-carousel").owlCarousel({
    items: 3,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 5000,
    loop: true,
    responsive: {
        0: {
            items: 2,
        },
        768: {
            items: 2,
        },
        1200: {
            items: 3,
        },
    },
});

const firstName = "aris";
const lastname = "ramadhan";
const age = 22;

const isMarried = true;
if (isMarried) {
    return "Sudah";
} else {
    return "Belum ";
}

console.log();

/**
 * Buatlah logika if untuk mengevaluasi nilai score dengan ketentuan:
 *  1. Jika score bernilai 90 atau lebih
 *      - Isi variabel result dengan nilai: 'Selamat! Anda mendapatkan nilai A.'
 *  2. Jika score bernilai 80 hingga 89
 *      - Isi variabel result dengan nilai: 'Anda mendapatkan nilai B.'
 *  3. Jika score bernilai 70 hingga 79
 *      - Isi variabel result dengan nilai: 'Anda mendapatkan nilai C.'
 *  4. Jika score bernilai 60 hingga 69:
 *      - Isi variabel result dengan nilai: 'Anda mendapatkan nilai D.'
 *  5. Jika score bernilai di bawah 60:
 *      - Isi variabel result dengan nilai: 'Anda mendapatkan nilai E.'
 *
 *
 *  Note: - Mohon untuk tidak menghapus kode yang sudah ada sebelumnya.
 *        - Anda tidak perlu membuat variabel result dan score secara manual.
 *          Gunakan variabel yang sudah disediakan.
 *
 */
if (score =<90) {
  result = 'Selamat! Anda mendapatkan nilai A.'
} else if (score =<80) {
  result = 'Selamat! Anda mendapatkan nilai B.'
} else if (score =<70) {
  result = 'Selamat! Anda mendapatkan nilai C.'
}else if (score =<60) {
  result = 'Selamat! Anda mendapatkan nilai D.'
}
else {
  result = 'Selamat! Anda mendapatkan nilai E.'
  
}

if (score >= 90) 
{
    result = "Selamat! Anda mendapatkan nilai A.";
} 

else if (score >= 80 && score <= 89) 
{
result = "Anda mendapatkan nilai B.";
} 

else if (score >= 70 && score <= 79) 
{
result = "Anda mendapatkan nilai C.";
} 

else if (score >= 60 && score <= 69) 
{
result = "Anda mendapatkan nilai D.";
} 

else 
{
result = "Anda mendapatkan nilai E.";
} 


/**
 * TODO
 * 1. Buatlah variabel dengan nama restaurant yang bertipe object dengan ketentuan berikut:
 *    - Memiliki properti bernama "name"
 *       - Bertipe data string
 *       - Bernilai apa pun, asalkan tidak string kosong atau null.
 *    - Memiliki properti bernama "city"
 *       - Bertipe data string
 *       - Bernilai apa pun, asalkan tidak string kosong atau null.
 *    - Memiliki properti "favorite drink"
 *       - Bertipe data string
 *       - Bernilai apa pun, asalkan tidak string kosong atau null.
 *    - Memiliki properti "favorite food"
 *       - Bertipe data string
 *       - Bernilai apa pun, asalkan tidak string kosong atau null.
 *    - Memiliki properti "isVegan"
 *       - Bertipe data boolean
 *       - Bernilai boolean apa pun.
 *
 * 2. Buatlah variabel bernama name.
 *    Kemudian isi dengan nilai name dari properti object restaurant
 * 3. Buatlah variabel bernama favoriteDrink.
 *    Kemudian isi dengan nilai "favorite drink" dari properti object restaurant
 */


// TODO
const restaurant = {
	name:"Aris",
  	city:"Jakarta",
  	"favorite drink":"water",
  	"favorite food":"cilok",
  	"isVegan":true
}

const {name} = restaurant;

const {'favorite drink': favoriteDrink } = restaurant;

console.log(name,favoriteDrink,restaurant['favorite drink'])
/**
 * Jangan hapus kode di bawah ini
 */
module.exports = { restaurant, name, favoriteDrink };


