 $(document).ready(inicio);
function inicio()
{
    
    $('#formu').on('submit',
    function(e)
    {
        //var per=new persona();
        var name;
        name = $('input[type=text]').map(function() {
            if($(this).val().length===0)
            {
               alert('campo vacio '+$(this).attr('name'));
                e.preventDefault();
            }
            return $(this).val();
        }).get();
       
        alert('Name: ' + name.join(', '));
    }          
    );

        
    var persona;
    persona.checks();



}
/**
 * $("#formu").find(':input').each(function() {
         var elemento= this;
         alert("elemento.id="+ elemento.id + ", elemento.value=" + elemento.value); 
        });
 * 
 * function caca(e)
        {
            
            var cosa;
            cosa=$('input[type=text]:text').map(function() {
                var valor=$(this).val();
                if(valor.equals('') )
                {
                    valor.css(color,red);
                    e.preventDefault();
                }
                else
                {
                    return valor;
                }
    }).get();
    alert('Name: ' + cosa.join(', '));
        }
 * 
 * 
 * var cadena = $(this).serialize();
        //alert(cadena);
        alert($(this).val());
        persona=new persona (this.nombre,this.apellidos,this.email,this.poblacion,this.provincia,this.edad);
        alert(persona.nombre);
        return false;
 * @returns {persona}
 */

/**
 * 
 * @param {type} nombre
 * @param {type} apellidos
 * @param {type} email
 * @param {type} poblacion
 * @param {type} provincia
 * @param {type} edad
 * @returns {persona}
 */


function persona(nombre,apellidos,email,poblacion,provincia,edad)
{
    this.nombre=nombre;
    this.apellidos=apellidos;
    this.email=email;
    this.poblacion=poblacion;
    this.provincia=provincia;
    this.edad=edad;
    this.checks=checks();
}





function checks()
{
    var ids;

    ids = $('input[type=checkbox]:checked').map(function() {
        return $(this).attr('value');
    }).get();

    alert('Name: ' + ids.join(', '));


    enviar.click(function () {
        checks();
        cogerDatos2();
        }

    );
}