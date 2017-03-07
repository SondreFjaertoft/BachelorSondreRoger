<?php require("view/header.php"); ?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <br> <br>     


    <div class="col-sm-3 col-md-4" style="border: solid black 1px">
        <h3 class="col-md-6"> LAGERSTATUS</h3>   
        <p style="margin-top: 22px">-- (Dropdown her med velg lager?)</p>
        <script>
            document.write('<p>Klokka di rågær: <span id="date-time">', new Date().toLocaleString(), '<\/span>.<\/p>');
            if (document.getElementById)
                onload = function () {
                    setInterval("document.getElementById ('date-time').firstChild.data = new Date().toLocaleString()", 50);
                };
        </script>

        <canvas id="lagerstatus"></canvas>
        <script>
            var ctx = document.getElementById('lagerstatus').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["FMG", "Dekoder", "Roger", "Sondre", "Ole", "Tafjord", "DØØMEEE"],
                    datasets: [
                        {
                            label: "Antall produkter i lageret",
                            backgroundColor: [
                                'rgba(0, 46, 96, 0.7)',
                                'rgba(255, 211, 0, 0.7)',
                                'rgba(0, 46, 96, 0.7)',
                                'rgba(255, 211, 0, 0.7)',
                                'rgba(0, 46, 96, 0.7)',
                                'rgba(255, 211, 0, 0.7)',
                                'rgba(0, 46, 96, 0.7)'

                            ],
                            borderColor: [
                                'rgba(0, 46, 96, 1)',
                                'rgba(255, 211, 0, 1)',
                                'rgba(0, 46, 96, 1)',
                                'rgba(255, 211, 0, 1)',
                                'rgba(0, 46, 96, 1)',
                                'rgba(255, 211, 0, 1)',
                                'rgba(0, 46, 96, 1)'
                            ],
                            borderWidth: 1,
                            data: [65, 59, 80, 81, 56, 55, 0]
                        }
                    ]
                },
                options: {
                    legend: {
                        display: false
                    }
                }

            });
        </script>
    </div>
    <div class="col-sm-3 col-md-4">
        <h3> MEST SOLGTE PRODUKTER </h3> 
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produkt</th>
                    <th>Lager</th>
                    <th>Antall</th>

                </tr>
            </thead>
            <tbody>

                <!-- HER KOMMER TABELL INNHOLDET>   -->  

            </tbody>
        </table>
    </div>
    <div class="col-sm-3 col-md-4">
        <h3> SISTE SALG </h3> 
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produkt</th>
                    <th>Lager</th>
                    <th>Antall</th>
                </tr>
            </thead>
            <tbody>

                <!-- HER KOMMER TABELL INNHOLDET>   -->  

            </tbody>
        </table>


    </div>







    <!-- HER KOMMER INNHOLDET>   -->                

</div>
