<!Doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <title> Task4 </title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->    
    </head>
    <body>
        <form action="index.php" method="POST">
            <div class="panel panel-default">

                <!-- Default panel contents -->
                <div class="panel-heading">
                    SQL
                    <p style="color:red"><?php echo $msgMy ?></p>
                </div>
                <!-- Table -->
                <table class="table">
                %TABLE%
                </table>
            </div>                                                    
        </form>
    </body>
</html>
