async function fetchRedeemedData() {
    try {
        const response = await fetch("../src/admin/php/charts/getRedeemData.php"); // URL to your PHP script
        const jsonData = await response.json();
        return jsonData;
    } catch (error) {
        console.error("Error fetching data:", error);
    }
}

async function renderChart() {
    const recyclingData = await fetchRedeemedData();

    const labels = recyclingData.labels; // Months with data from PHP
    const datasets = recyclingData.datasets; // Datasets with monthly counts per item

    const data = {
        labels: labels, // Months
        datasets: datasets, // Each item with its monthly counts
    };

    const config = {
        type: "bar", // Chart type
        data: data,
        options: {
            responsive: true, // Make the chart responsive
            scales: {
                y: {
                    beginAtZero: true, // Ensure the Y-axis starts at 0
                },
            },
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true, // Use custom point style in legend
                        pointStyle: 'roundedRect', // Rounded legend icons
                        boxWidth: 15, // Width of legend box
                        boxHeight: 10, // Height of legend box
                    },
                },
            },
            elements: {
                bar: {
                    borderRadius: 10, // Rounded corners on bars
                    borderWidth: 1, // Bar border width
                },
            },
        },
    };

    const myChart = new Chart(document.getElementById("myChartRedeem"), config);
}

// Initialize and render the chart
renderChart();
