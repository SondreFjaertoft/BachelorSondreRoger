
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Tafjord</title>

        <!-- Bootstrap -->
        <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="style/home.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="?page=home">Tafjord Marked</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Sondre Fjærtoft<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>Rediger profil</li>
                            <li>Logg ut</li>
                        </ul>
                    </li> 
                </ul>
                <form class="navbar-form navbar-right">
                    <input type="text" class="form-control" placeholder="Søk..">
                </form>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li><a href="?page=home">Home</a></li>
                        <li><a href="?page=createUser">Bruker Administrering</a></li>
                        <li><a href="../">Logout</a></li>
                    </ul>

                </div>


            </div>

        </div>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../Bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>