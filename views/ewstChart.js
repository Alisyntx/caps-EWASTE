async function fetchRecyclingData() {
    try {
        const response = await fetch("../src/admin/php/charts/getRecycleData.php"); // URL to your PHP script
        const jsonData = await response.json();
        return jsonData;
    } catch (error) {
        console.error("Error fetching data:", error);
    }
}

async function renderChart() {
    const recyclingData = await fetchRecyclingData();

    const labels = recyclingData.labels;  // Months with data from PHP
    const datasets = recyclingData.datasets;  // Datasets with monthly counts per item

    const data = {
        labels: labels,  // Months
        datasets: datasets,  // Each item with its monthly counts
    };

    const config = {
        type: "line",  // Line chart
        data: data,
        options: {
            responsive: true,  // Make the chart responsive
            scales: {
                y: {
                    beginAtZero: true,  // Ensure the Y-axis starts at 0
                },
            },
        },
    };

    const myChart = new Chart(document.getElementById("myChart"), config);
}

// Initialize and render the chart
renderChart();