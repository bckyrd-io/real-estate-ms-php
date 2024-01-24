$(function () {
    $.getJSON('chart__data.php', function (data) {
        if (data.error) {
            console.error('Error fetching data:', data.error);
            return;
        }

        // Profit Chart - Total Plots Sold Per Location
        var plotLocations = data.plotsData.map(item => item.location);
        var totalSold = data.plotsData.map(item => parseInt(item.total_sold));

        var profitChartOptions = {
            series: [{ name: "Total Plots Sold", data: totalSold }],
            chart: {
                type: "bar",
                height: 345,
                toolbar: { show: true },
                foreColor: "#adb0bb",
                fontFamily: 'inherit',
                sparkline: { enabled: false },
            },
            colors: ["#8a0000"],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "35%",
                    borderRadius: 6
                },
            },
            dataLabels: { enabled: false },
            grid: {
                borderColor: "rgba(0,0,0,0.1)",
                strokeDashArray: 3,
                xaxis: { lines: { show: false } },
            },
            xaxis: {
                type: "category",
                categories: plotLocations,
                labels: {
                    style: { cssClass: "grey--text lighten-2--text fill-color" },
                },
            },
            yaxis: {
                show: true,
                labels: {
                    style: { cssClass: "grey--text lighten-2--text fill-color" },
                },
            },
            tooltip: { theme: "light" },
            responsive: [
                {
                    breakpoint: 600,
                    options: {
                        plotOptions: { bar: { borderRadius: 3 } },
                    }
                }
            ]
        };
        new ApexCharts(document.querySelector("#chart"), profitChartOptions).render();

        // Earnings Chart - Total Earnings Per Month
        if (data.earningsData && data.earningsData.length > 0) {
            var earningsMonths = data.earningsData.map(item => item.month);
            var totalEarnings = data.earningsData.map(item => parseFloat(item.total_earnings));

            var earningOptions = {
                chart: {
                    id: "sparkline3",
                    type: "area",
                    height: 60,
                    sparkline: { enabled: true },
                    group: "sparklines",
                    fontFamily: "Plus Jakarta Sans', sans-serif",
                    foreColor: "#adb0bb",
                },
                series: [{
                    name: "Earnings",
                    color: "#8a0000",
                    data: totalEarnings,
                }],
                stroke: { curve: "smooth", width: 2 },
                fill: {
                    colors: ["#f3feff"],
                    type: "solid",
                    opacity: 0.05,
                },
                markers: { size: 0 },
                xaxis: { categories: earningsMonths },
                tooltip: {
                    theme: "dark",
                    fixed: { enabled: true, position: "right" },
                    x: { show: false },
                },
            };
            new ApexCharts(document.querySelector("#earning"), earningOptions).render();
        } else {
            console.error('No earnings data available');
        }
    });
});
