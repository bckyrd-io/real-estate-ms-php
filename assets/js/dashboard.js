$(function () {

    // Fetch the chart data
    $.getJSON('chart__data.php', function (data) {
        if (data.error) {
            console.error('Error fetching data:', data.error);
            return;
        }
        // Assuming data.plotsData and data.usersonplotData are arrays with your data
        // Modify these lines according to the actual structure of your data
        var plotLocations = data.plotsData.map(item => item.location);
        var totalSold = data.plotsData.map(item => parseInt(item.total_sold));
        var userStatuses = data.usersonplotData.map(item => item.status);
        var statusCounts = data.usersonplotData.map(item => parseInt(item.total_status));

        // =====================================
        // Use the data in your chart configurations
        // 



        // =====================================
        // Profit
        // =====================================
        // Example: Update Profit Chart
        var profitChartOptions = {
            series: [
                { name: "Total Plots Sold", data: totalSold },
                { name: "Expense this month:", data: [280, 250, 325, 215, 250, 310, 280, 250] },
            ],

            chart: {
                type: "bar",
                height: 345,
                offsetX: -15,
                toolbar: { show: true },
                foreColor: "#adb0bb",
                fontFamily: 'inherit',
                sparkline: { enabled: false },
            },


            colors: ["#8a0000","#13DEB9"],


            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "35%",
                    borderRadius: [6],
                    borderRadiusApplication: 'end',
                    borderRadiusWhenStacked: 'all'
                },
            },
            markers: { size: 0 },

            dataLabels: {
                enabled: false,
            },


            legend: {
                show: false,
            },


            grid: {
                borderColor: "rgba(0,0,0,0.1)",
                strokeDashArray: 3,
                xaxis: {
                    lines: {
                        show: false,
                    },
                },
            },

            xaxis: {
                type: "category",
                categories: ["16/08", "17/08", "18/08", "19/08", "20/08", "21/08", "22/08", "23/08"],
                labels: {
                    style: { cssClass: "grey--text lighten-2--text fill-color" },
                },
            },


            yaxis: {
                show: true,
                min: 0,
                max: 400,
                tickAmount: 4,
                labels: {
                    style: {
                        cssClass: "grey--text lighten-2--text fill-color",
                    },
                },
            },
            stroke: {
                show: true,
                width: 3,
                lineCap: "butt",
                colors: ["transparent"],
            },


            tooltip: { theme: "light" },

            responsive: [
                {
                    breakpoint: 600,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 3,
                            }
                        },
                    }
                }
            ]


        };

        var profitChart = new ApexCharts(document.querySelector("#chart"), profitChartOptions);
        profitChart.render();







        // =====================================
        // Earning
        // =====================================
        // Process 'earningsData' for the Earnings chart
        if (data.earningsData) {
            var earningsMonths = data.earningsData.map(item => item.month);
            var totalEarnings = data.earningsData.map(item => parseFloat(item.total_earnings));

            var earningOptions = {
                chart: {
                    id: "sparkline3",
                    type: "area",
                    height: 60,
                    sparkline: {
                        enabled: true,
                    },
                    group: "sparklines",
                    fontFamily: "Plus Jakarta Sans', sans-serif",
                    foreColor: "#adb0bb",
                },
                series: [{
                    name: "Earnings",
                    color: "#13DEB9",
                    data: totalEarnings,
                }],
                stroke: {
                    curve: "smooth",
                    width: 2,
                },
                fill: {
                    colors: ["#f3feff"],
                    type: "solid",
                    opacity: 0.05,
                },
                markers: {
                    size: 0,
                },
                xaxis: {
                    categories: earningsMonths,
                },
                tooltip: {
                    theme: "dark",
                    fixed: {
                        enabled: true,
                        position: "right",
                    },
                    x: {
                        show: false,
                    },
                },
            };

            new ApexCharts(document.querySelector("#earning"), earningOptions).render();
        }


    });
})