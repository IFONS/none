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
        <div class="row center-block">
            <div class="col-xs-offset-3 col-xs-6">
                <div class="thumbnail" id="thub1">
                    <div class="caption">
                        <form id="register" method="post" action="../opsbd/usuarioBD.php">
                            <h2>Register</h2>
                            <div class="form-row col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group  ">
                                    <label  for="emailoReg">Email</label>
                                    <div class="input-group mb-2 mb-sm-0">
                                        <div class="input-group-addon">@</div>
                                        <input type="text" class="form-control"  id="emailoReg" name="emailoReg" placeholder="Username" pattern="^[a-zA-Z0-9]+.[a-zA-Z0-9]+$" required>
                                    </div>
                                    <div class="invalid-feedback"  id="feedEmilio">

                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="alias">Usuario</label>
                                    <input type="text" class="form-control is-valid" id="alias" name="usuario" required>
                                    <div class="invalid-feedback"  id="feedAlias">

                                    </div>
                                </div>
                                
                                <div class="form-group ">
                                    <label for="passwordReg">Contraseña</label>
                                    <input type="password" class="form-control is-valid" id="passwordReg" name="passwordReg" placeholder="Password" autofocus ="autofocus" required>
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                            
                            
                                <div class="form-group">
                                    <label for="passwordReg2">Repite Contraseña</label>
                                    <input type="password" class="form-control is-valid" id="passwordReg2" name="passwordReg2" placeholder="Password" required>
                                    <div class="invalid-feedback"  id="feedContras">

                                    </div>
                                </div>
                                
                            
                            </div>

                            <button type="submit" class="btn btn-primary" name="submito">sign up</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/js.js"></script>
    </body>
</html>
