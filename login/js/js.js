/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(inicio);

function inicio()
{
    correo();
}

function correo ()
{
     var correo = $('[name=emailoReg]');
    function coincideEmilio()
    {
        //e.preventDefault();
        var emailo =correo.val();
        var datos=correo.serialize();
        var resultado;
        var reg = /^[a-zA-Z0-9]+.[a-zA-Z0-9]+$/;
        if( !emailo.match(reg) )
        {
            $('#feedEmilio').html('<div class="alert alert-danger" role="alert"> <strong>Warning!</strong>Correo no valido.</div>');
        }
        else
        {
            $.ajax
            ({
                type: 'POST',
                url: '../opsbd/usuarioBD.php',
                data: datos,
                success: function (data)
                {
                    resultado=data;
                    if(resultado==true)
                    {
                        $('#feedEmilio').html('<div class="alert alert-success" role="alert"><strong>SUCCES!</strong> Correo libre.</div>');
                        return resultado;
                    }
                    else
                    {
                        $('#feedEmilio').html('<div class="alert alert-danger" role="alert"> <strong>Warning!</strong>Correo en uso.</div>');
                        return resultado;
                    }
                },
                error: function (error)
                {
                    alert("error del servidor");
                    console.log('Llamada Oo--> '+error);
                }
            });
        }
    }
    correo.blur(function () {
            coincideEmilio();
        }
    );
}