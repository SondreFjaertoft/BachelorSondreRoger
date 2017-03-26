
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Tafjord</title>
        
        <script src="/system/jquery-3.1.1.min.js"></script>
        <!-- Bootstrap -->
        <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="style/home.css" rel="stylesheet">
        <script src="js/handlebars-v4.0.5.js"></script>
           <!-- MetisMenu CSS -->
   
         <script src="Bootstrap/js/bootstrap.min.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

            <div class="container-fluid">
                <div class="navbar-header">
                    
                    <a class="navbar-left" href="?page=home" style="margin-left: 50px; margin-top: 5px;">
                        <img src="image/tafjordLogo.png" alt="Home">
                    </a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#usernav"><span class="glyphicon glyphicon-user"></span> <?php echo  $_SESSION["nameOfUser"]; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a>Rediger profil</a></li>
                            <li><a href="../">Logout</a></li>
                        </ul>
                    </li> 
                </ul>
                <form class="navbar-form navbar-right">
                    <input type="text" class="form-control" placeholder="Søk..">
                </form>
                
            </div>
        
        <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                    


                        <li><a href="?page=home">Home</a></li>
                        <li><a href="?page=sale">Registrer Uttak</a></li>
                        <li><a href="?page=return">Registrer Retur</a></li>
                        <li><a href="?page=transfer">Overføring</a></li>
                        <li><a href="?page=mySales">Dine Salg</a></li>
                        <li><a href="?page=myReturns">Dine Returer</a></li>
                        
                        <?php if ($_SESSION["userLevel"] == "Administrator") {?>
                        <li>
                        <a id="show-hide-toogle" href="#">Administrering</a>
                        
                            <ul id="dropdown" class="nav nav-second-level">
                                <li>
                                    <a href="?page=userAdm">Bruker Administrering</a>
                                </li>
                                <li>
                                    <a  href="?page=storageAdm">Lager Administrering</a>
                                </li>
                                <li>
                                    <a href="?page=productAdm">Produkt Administrering</a>
                                </li>
                            </ul>
                  
                        </li>
                        <?php }?>
          
     

                </div>


            </div>
            </nav>
      

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="Bootstrap/js/bootstrap.min.js"></script>
        <script src="Charts/Chart.js"></script>
        
<script>
$('#dropdown').hide();

$(document).ready(function(){
    $("#show-hide-toogle").click(function(){
        $("#dropdown").toggle();
    });
});
 
</script>