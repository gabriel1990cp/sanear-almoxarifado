new Chart(document.getElementById("bar-chart-grouped"), {
    type: 'bar',
    data: {
        labels: ["1900", "1950", "1999", "2050"],
        datasets: [
            {
                label: "Pendente",
                backgroundColor: "#3e95cd",
                data: [133, 221, 783, 2478]
            }, {
                label: "Executado",
                backgroundColor: "#8e5ea2",
                data: [408, 547, 675, 734]
            }
        ]
    },
    options: {
        title: {
            display: true,
            text: 'Gráfico com as baixas.'
        }
    }
});
