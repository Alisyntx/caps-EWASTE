// Step 1: Define your labels (months)
const labels = ["January", "February", "March", "April", "May", "June", "July"];

// Step 2: Set up the data for the chart
const data = {
    labels: labels,
    datasets: [
        {
            label: "My First Dataset",
            data: [65, 59, 80, 81, 56, 55, 40],
            backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(255, 159, 64, 0.2)",
                "rgba(255, 205, 86, 0.2)",
                "rgba(75, 192, 192, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(153, 102, 255, 0.2)",
                "rgba(201, 203, 207, 0.2)",
            ],
            borderColor: [
                "rgb(255, 99, 132)",
                "rgb(255, 159, 64)",
                "rgb(255, 205, 86)",
                "rgb(75, 192, 192)",
                "rgb(54, 162, 235)",
                "rgb(153, 102, 255)",
                "rgb(201, 203, 207)",
            ],
            borderWidth: 1,
        },
    ],
};

// Step 3: Set up the chart configuration
const config = {
    type: "line", // You can change this to 'line', 'pie', etc.
    data: data,
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    font: {
                        family: "Verdana, sans-serif", // Y-axis font family
                        size: 8, // Y-axis font size
                        style: "bold", // Y-axis font style
                    },
                },
            },
            x: {
                ticks: {
                    font: {
                        family: "Verdana, sans-serif", // X-axis font family
                        size: 9, // X-axis font size
                        style: "italic", // X-axis font style
                    },
                },
            },
        },
        plugins: {
            legend: {
                labels: {
                    font: {
                        family: "Comic Sans MS, cursive", // Legend font family
                        size: 9, // Legend font size
                        style: "bold", // Legend font style
                    },
                },
            },
        },
    },
};

// Step 4: Initialize and render the chart
const myChart = new Chart(document.getElementById("myChart"), config);
