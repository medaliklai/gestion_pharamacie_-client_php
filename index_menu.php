<!DOCTYPE html>


<html lang="en">

<head>

    <title>gestion de médicaments</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style_slider.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    #navbar {
        overflow: hidden;
        background-color: transparent;
        padding: 90px 10px;
        transition: 0.4s;
        position: fixed;
        width: 100%;
        top: 0;

        height: 400px;
    }

    #navbar a {

        float: left;
        color: black;
        text-align: center;
        padding: 12px;
        text-decoration: none;
        font-size: 18px;
        line-height: 25px;
        border-radius: 4px;
        color: white;
        border-radius: 15px;
        transform: scale(1);
        transition: 0.3s;
    }

    #navbar #logo {
        font-size: 35px;
        font-weight: bold;
        transition: 0.4s;
        position: absolute;
        top: -40px;
        left: 20px;
    }

    #navbar #logo:hover {
        background-color: transparent;
    }

    #navbar a:hover {
        background-color: rgb(255, 248, 220);
        color: dodgerblue;
        transform: scale(1.1);

    }

    #navbar-right {
        float: right;
        position: absolute;
        left: 900px;
        background-color: rgba(30, 144, 255, 0.8);
        border-radius: 15px;
        top: 30px;




    }

    #navbar-right:hover {
        background-color: rgba(144, 238, 144, 0.8);



    }

    @ #navbar a {
        float: none;

        text-align: left;

    }

    #navbar-right {
        float: none;
    }


    .dropdown {
        position: relative;
        display: inline-block;

    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: rgba(144, 238, 144, 0.8);

        min-width: 160px;
        box-shadow: 4px 8px 4px 0px rgba(144, 238, 144, 0.8);
        z-index: 1;
        top: 65px;
        border-radius: 15px;
    }


    .dropdown-content a {
        color: orange;
        padding: 12px 16px;
        text-decoration: none;
        display: block;

    }

    .dropdown-content a:hover {
        background-color: blue;
    }

    .dropdown:hover .dropdown-content {
        display: block;


    }
    </style>
</head>

<body>
    <div id="navbar">

        <a href="http://localhost/g_pharmacie/index.php" id="logo"><img src="images/logo6.png"></a>
        <div id="navbar-right">

            <a href="http://localhost/g_pharmacie/contact.php">
                <h4> Contact </h4>
            </a>



            <a href="http://localhost/g_pharmacie/recherche_med.php">
                <h4><i class="glyphicon glyphicon-search"> </i></h4>
            </a>
            <a href="http://localhost/g_pharmacie/client/client_inscription.php">
                <h4><i class="glyphicon glyphicon-user"></i> S'inscrir</h4>
            </a>
            <div class="dropdown">
                <a href="#">
                    <h4><i class="glyphicon glyphicon-log-in"></i> Connexion</h4>
                </a>
                <div class="dropdown-content">
                    <a href="http://localhost/g_pharmacie/admin/login_admin.php" style="color:black;">Admin</a></br>
                    <a href="http://localhost/g_pharmacie/pharmacien/login_pharmacien.php"
                        style="color: black; ">Pharmacien</a>
                    <a href="http://localhost/g_pharmacie/client/login_client.php" style="color:black;">Client</a>
                    <a href="http://localhost/g_pharmacie/fournisseur/login_fournisseur.php"
                        style="color:black;">Fournisseur</a>
                </div>
            </div>
        </div>

    </div>
    </div>



    <script>
    // When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
            document.getElementById("navbar").style.padding = "30px 10px";
            document.getElementById("logo").style.background - color = "silver";
        } else {
            document.getElementById("navbar").style.padding = "80px 10px";
            document.getElementById("logo").style.fontSize = "35px";
        }
    }
    </script>

</body>

</html>