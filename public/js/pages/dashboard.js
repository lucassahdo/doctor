$(document).ready(function () {
    chartColor = "#FFFFFF";
    chartColor = "#faff00"; // yellow    
    chartColor = "#2ffceb"; // blue'
    //chartColor = "#ff8300"; // orange

    // General configuration for the charts with Line gradientStroke
    gradientChartOptionsConfiguration = {
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10
        },
        responsive: 1,
        scales: {
            yAxes: [{
                display: 0,
                gridLines: 0,
                ticks: {
                    display: false
                },
                gridLines: {
                    zeroLineColor: "transparent",
                    drawTicks: false,
                    display: false,
                    drawBorder: false
                }
            }],
            xAxes: [{
                display: 0,
                gridLines: 0,
                ticks: {
                    display: false
                },
                gridLines: {
                    zeroLineColor: "transparent",
                    drawTicks: false,
                    display: false,
                    drawBorder: false
                }
            }]
        },
        layout: {
            padding: {
                left: 0,
                right: 0,
                top: 15,
                bottom: 15
            }
        }
    };

    var ctx = document.getElementById('bigDashboardChart').getContext("2d");

    var gradientStroke = ctx.createLinearGradient(0, 100, 0, 0);

    // ---
    gradientStroke.addColorStop(0, '#80b6f4');
    gradientStroke.addColorStop(0, '#faff00'); // yellow
    gradientStroke.addColorStop(0, '#2ffceb'); // blue
    //gradientStroke.addColorStop(0, '#ff8300'); // orange


    gradientStroke.addColorStop(1, chartColor);

    var gradientFill = ctx.createLinearGradient(0, 300, 0, 0);

    // ---
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(0, "#faff00"); // yellow
    gradientFill.addColorStop(0, "rgba(8, 224, 199, 0.66)"); // blue
    //gradientFill.addColorStop(0, "#ff8300"); // orange

    // ---
    gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)");
    gradientFill.addColorStop(1, "#faff00"); // yellow
    gradientFill.addColorStop(1, "rgba(8, 224, 199, 0.66)"); // blue
    //gradientFill.addColorStop(1, "#ff8300"); // orange

    var Chart_DashBoard = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dashboard.labels,
            datasets: [{
                label: "Data",
                borderColor: chartColor,
                pointBorderColor: chartColor,
                pointBackgroundColor: "#1e3d60",
                pointHoverBackgroundColor: "#1e3d60",
                pointHoverBorderColor: chartColor,
                pointBorderWidth: 1,
                pointHoverRadius: 7,
                pointHoverBorderWidth: 2,
                pointRadius: 0,
                fill: true,
                backgroundColor: gradientFill,
                borderWidth: 2,
                data: dashboard.data
            }]
        },
        options: {
            layout: {
                padding: {
                    left: 20,
                    right: 20,
                    top: 0,
                    bottom: 0
                }
            },
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: '#fff',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            legend: {
                position: "bottom",
                fillStyle: "#FFF",
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        fontColor: "rgba(255,255,255,0.4)",
                        fontStyle: "bold",
                        beginAtZero: true,
                        maxTicksLimit: 5,
                        padding: 10
                    },
                    gridLines: {
                        drawTicks: true,
                        drawBorder: false,
                        display: true,
                        color: "rgba(255,255,255,0.1)",
                        zeroLineColor: "transparent"
                    }

                }],
                xAxes: [{
                    gridLines: {
                        zeroLineColor: "transparent",
                        display: false,

                    },
                    ticks: {
                        padding: 10,
                        fontColor: "rgba(255,255,255,0.4)",
                        fontStyle: "bold"
                    }
                }]
            }
        }
    });
});

$(document).ready(function () {
    // PRODUCTS
    var ctx = document.getElementById("canvasProducts");
    var data = {
        labels: ["Organic", "From Hintfy.io"],
        datasets: [{
            data: [2214, 935],
            backgroundColor: ["#05252c", "#48b396"],
            hoverBackgroundColor: ["#05252c", "#48b396"]
        }]
    };
    var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
        data: data,
        options: {
            legend: {
                display: false
            }
        }
    });

    // ---
    var ctx = document.getElementById("canvasOrders");
    var data = {
        labels: ["Organic", "From Hintfy.io"],
        datasets: [{
            data: [6539, 2800],
            backgroundColor: ["#05252c", "#48b396"],
            hoverBackgroundColor: ["#05252c", "#48b396"]
        }]
    };
    var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
        data: data,
        options: {
            legend: {
                display: false
            }
        }
    });

    // ---
    var ctx = document.getElementById("canvasCustomers");
    var data = {
        labels: ["Organic", "From Hintfy.io"],
        datasets: [{
            data: [3562, 1200],
            backgroundColor: ["#05252c", "#48b396"],
            hoverBackgroundColor: ["#05252c", "#48b396"]
        }]
    };
    var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
        data: data,
        options: {
            legend: {
                display: false
            }
        }
    });

    // ---
    var ctx = document.getElementById("canvasRevenue");
    var data = {
        labels: ["Organic", "From Hintfy.io"],
        datasets: [{
            data: [150890321.76, 50456268.27],
            backgroundColor: ["#05252c", "#48b396"],
            hoverBackgroundColor: ["#05252c", "#48b396"]
        }]
    };
    var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
        data: data,
        options: {
            legend: {
                display: false
            }
        }
    });
});


$(document).ready(function () {
    ctx = document.getElementById('notuse_averageSpend').getContext("2d");
    gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#80b6f4');
    gradientStroke.addColorStop(1, '#80b6f4');
    gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, "rgba(249, 99, 59, 0.40)");
    myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Active Users",
                borderColor: "#f96332",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#f96332",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                fill: true,
                backgroundColor: gradientFill,
                borderWidth: 2,
                data: [700, 600, 500, 640, 490, 450, 480, 500, 520, 450, 430, 450]
            }]
        },
        options: gradientChartOptionsConfiguration
    });

    ctx = document.getElementById('notuse_productsAverage').getContext("2d");
    gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#3900c8');
    gradientStroke.addColorStop(1, '#3900c8');
    gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, hexToRGB('#3900c8', 0.4));
    myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["12pm,", "3pm", "6pm", "9pm", "12am", "3am", "6am", "9am"],
            datasets: [{
                label: "Email Stats",
                borderColor: "#3900c8",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#3900c8",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                fill: true,
                backgroundColor: gradientFill,
                borderWidth: 2,
                data: [1500, 1400, 1500, 1600, 1200, 1250, 1300, 900]
            }]
        },
        options: gradientChartOptionsConfiguration
    });

    ctx = document.getElementById('use_averageSpend').getContext("2d");
    gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#80b6f4');
    gradientStroke.addColorStop(1, '#80b6f4');
    gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, "rgba(249, 99, 59, 0.40)");
    myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Active Users",
                borderColor: "#f96332",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#f96332",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                fill: true,
                backgroundColor: gradientFill,
                borderWidth: 2,
                data: [542, 600, 570, 550, 650, 720, 600, 750, 768, 810, 900, 1200]
            }]
        },
        options: gradientChartOptionsConfiguration
    });

    ctx = document.getElementById('use_productsAverage').getContext("2d");
    gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#3900c8');
    gradientStroke.addColorStop(1, '#3900c8');
    gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, hexToRGB('#3900c8', 0.4));
    myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["12pm,", "3pm", "6pm", "9pm", "12am", "3am", "6am", "9am"],
            datasets: [{
                label: "Email Stats",
                borderColor: "#3900c8",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#3900c8",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                fill: true,
                backgroundColor: gradientFill,
                borderWidth: 2,
                data: [450, 500, 650, 850, 1200, 1250, 1300, 1900]
            }]
        },
        options: gradientChartOptionsConfiguration
    });
});