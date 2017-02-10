
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Bootstrap 101 Template</title>

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
                    <a class="navbar-brand" href="#">Tafjord Marked</a>
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
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <br><br><br><br>
  
        <form action="?page=addUserEngine" method="post">
        Name:<br>
        <input type="text" name="givenName" value=""><br>
        Brukernavn:<br>
        <input type="text" name="givenUsername" value=""><br>
        Password:<br>
        <input type="text" name="givenPassword" value=""><br>
        UserLevel:<br>
        <input type="text" name="givenUserLevel" value=""><br>
        Email:<br>
        <input type="text" name="givenEmail" value=""><br>
        <br>
        <input type="submit" value="Submit">
        </form>       
                    
                    
                </div>
            </div>

        </div>
        <!--<nav class="navbar-left navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-default">
                    <ul class="nav navbar-nav">
                        <li class="active">Test</li>
                        <li>Test2</li>
                        <li>test3</li>
                    </ul>
                    
                </div>
            </div>
            
        </nav> -->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../Bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>