const graph = document.getElementById('graph');

const test = new Chart(graph, {
    type: "doughnut",
    data: {
        labels: ["test","ok","bon","alors"],
        datasets: [{
            data: [140,500,800,300],
            backgroundColor:[
                "lightBlue",
                "pink",
                "red",
                "green",
            ],
            hoverOffset: 80
        }],
    },
    options: {

    }
});