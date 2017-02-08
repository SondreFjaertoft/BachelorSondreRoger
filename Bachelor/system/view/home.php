

<!-- FOR Å TESTE TING SÅNN AT ME IKKJE ØDELEGGE DET SOM FUNKA -->

<!-- SKAL SLETTES FØR ME E FERDIG -->

<!DOCTYPE html>
<html>
    <head>
        <title>Tafjord</title>
        <link rel="stylesheet" type="text/css" href="style/home.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="wrapper">
            <div id="sidenav">
                <nav >
                    <ul>
                        <li id="bildeli">
                            <img src="image/TafjordLogo.png" alt="Tafjord logo">
                        </li>
                        <li class="sideLi">
                            <a>Home</a>
                        </li>
                        <li class="sideLi">
                            <a>Salg</a>
                        </li>
                        <li class="sideLi">
                            <a>Salg</a>
                        </li>
                        
                        <li class="sideLi">
                            <a href="../">Logout</a>
                        </li>
            <!--<li><a href="#about">Customer</a></li>
            <li><a href="#contact">Support</a></li> -->
     
                    </ul>
                </nav>
            </div>
            <div id="header">
                <div>
                    <ul>
                        <li>
                            <div id="formwrapper">
                                <form>
                                    <input type="text" id="searchfield" placeholder="Søk..">
                                </form>
                            </div>
                        </li>
                        <li>
                            <div id="datetime">
                                <p id="date">

                                </p>
                                <script>
                                    n = new Date();
                                    y = n.getFullYear();
                                    m = n.getMonth() + 1;
                                    d = n.getDate();
                                    document.getElementById("date").innerHTML = d + "/" + m + "/" + y;
                                </script>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>


        </div>

    </body>
</html>
