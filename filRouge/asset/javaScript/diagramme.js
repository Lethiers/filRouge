const graph = document.getElementById('graph');

function diagramme($a,$b) {

    new Chart(graph, {
        type: "doughnut",
        data: {
            labels: $a,
            datasets: [{
                data: $b,
                backgroundColor:[
                    "lightBlue",
                    "pink",
                    "red",
                    "green",
                ],
                hoverOffset: 30
            }],
        },
        options: {
    
        }
    });
}
