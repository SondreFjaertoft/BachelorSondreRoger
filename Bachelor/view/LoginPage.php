<!DOCTYPE html>
<html>
    <head>
        <title>Tafjord</title>
        <link rel="stylesheet" type="text/css" href="system/style/indexcss.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body>
        <script type="text/javascript" src="../system/js/hide-show-password.js"></script>

        <div>
            <img src="../image/TafjordLogo.png" alt="Tafjord" class="index-bilde">
        </div>
        <header>
            <h1>Velkommen til lagersystemet til tafjord</h1>
            <h2>Vennligst logg inn</h2>
        </header>

        <button onclick="document.getElementById('id01').style.display = 'block'">Login</button>

        <div id="id01" class="modal">


            <!-- Modal innhold -->
            <form class="modal-content animate" id="login" action="?page=loginEngine" method="post">
                <div class="imgcontainer">
                    <img src="../image/TafjordLogo.png" alt="Avatar" class="avatar">
                </div>
                <div class="container">
                    <label><b>Brukernavn</b></label>
                    <input type="text" placeholder="Vennligst fyll inn brukernavn" name="givenUsername" required>

                    <label><b>Passord</b></label>

                    <input type="password" id="psw" placeholder="Vennligst fyll inn passord" name="givenPassword" required>
                    <input type="checkbox" id="show-hide" name="show-hide" value=""> Show Password
                    <button type="submit">Login</button>



                </div>
                <div class="container" style="background-color: #f1f1f1">
                    <button type="button" onclick="document.getElementById('id01').style.display = 'none'" class="cancelbtn">Avbryt</button>
                    <span class="psw"><a href="#">Glemt passord</a></span>
                </div>
            </form>
        </div>
        <script>
            var modal = document.getElementById("id01");

            window.onclick = function (event)
            {
                if (event.target === modal)
                {
                    modal.style.display = "none";
                }
            };

        </script>
    </body>


</html>




