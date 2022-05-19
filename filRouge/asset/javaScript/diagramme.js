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


// const graph = document.getElementById('graph');

// const test = new Chart(graph, {
//     type: "doughnut",
//     data: {
//         labels: ["test","ok","bon","alors"],
//         datasets: [{
//             data: [140,500,800,300],
//             backgroundColor:[
//                 "lightBlue",
//                 "pink",
//                 "red",
//                 "green",
//             ],
//             hoverOffset: 80
//         }],
//     },
//     options: {

//     }
// });