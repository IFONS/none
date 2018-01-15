$(document).ready(inicio);
function inicio()
{

    cogerDatos();


}

function cogerDatos()
{
    var enviar =$('[name=enviar]');
    var nombre = $('[name=nombre]');
    var apellidos=$('[name=apellidos]');
    var email=$('[name=email]');
    var poblacion=$('[name=poblacion]');
    var provincia =$('[name=provincia]');
    var edad=$('[name=edad]');
    function cogerDatos2()
    {


        var n=nombre.val();
        var apes= apellidos.val();
        var em= email.val();
        var pob=poblacion.val();
        var prov=provincia.val();
        var ed=edad.val();
        alert(n);
        alert(apes);
        alert(em);
        alert(pob);
        alert(prov);
        alert(ed);



    }
   function checks() {
        var ids;

        ids = $('input[type=checkbox]:checked').map(function() {
            return $(this).attr('value');
        }).get();

        alert('Name: ' + ids.join(', '));
    }

    enviar.click(function () {
        checks();
        cogerDatos2();
        }

    )
}