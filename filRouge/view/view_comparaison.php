
    <title>comparaison</title>
    <link rel="stylesheet" href="./asset/css/comparer.css">
</head>
<body>
    <div class ="container">


    <form action="" method="post">

        <img src="./asset/image/gateau.png" alt="">
        <h3>Choisir une date:</h3>
        <p>N'oubliez pas de choisir une date précise</p>
        <div class="top_container">
        <input type="date" name="date_operation">
        </div>


        <div class="chart_container">
        <canvas id="graph" aria-label="chart" role="img"></canvas>
        </div>
        <input type="submit" value="comparer" class="bouton">
        </form>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script src="./asset/javaScript/diagramme.js"></script>
</body>
</html>