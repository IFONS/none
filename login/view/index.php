<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>
    <body>
        <?php
        // put your code here
        
        
        ?>
        
        {% block login%}
            <!-- aqui ira el login -->
            <div class="row">
                <div class="row center-block">
                    <div class="col-xs-offset-3 col-xs-6">
                        <div class="thumbnail" id="login">
                            <div class="caption text-center">
                                <h3>Login!</h3>
                                <h6>Correo</h6>
                                <p><input type="email" name="usuario"/></p>
                                <h6>Contraseña</h6>
                                <p><input type="password" name="contraseña"/></p>
                                <p><a href="#" class="btn btn-primary" role="button"  onclick="mostrarLogin()">Login</a>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {% endblock%}
    </body>
</html>
