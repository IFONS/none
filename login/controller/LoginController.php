<?php
class BodegasController{

    private $conectar;
    private $conexion;

    public function __construct() {
		require_once  __DIR__ . "/../core/Conectar.php";
        require_once  __DIR__ . "/../model/Bodega.php";
        require_once  __DIR__ . "/../model/Vino.php";
        $this->conectar=new Conectar();
        $this->conexion=$this->conectar->conexion();

    }

   /**
    * Ejecuta la acción correspondiente.
    *
    */
    public function run($accion){
        switch($accion)
        { 
            case "index" :
                $this->index();
                break;
            case "alta" :
                $this->crear();
                break;
            case "altaV" :
                $this->crearV();
                break;
            case "detalle" :
                $this->detalle();
                break;
            case "detalleV" :
                $this->detalleV();
                break;
            case "vinosV":
                $this-> vinosV();
                break;
            case "update":
                $this->update();
                break;
            case "updateV":
                $this->updateV();
                break;
            case "baja" :
                $this->borrar();
                break;
            case "bajaV" :
                $this->borrarV();
                break;
            case "volver" :
                $this->volver();
                break;
            default:
                $this->index();
                break;
        }
    }
    
   /**
    * Carga la página principal de empleados con la lista de
    * bodegas que consigue del modelo.
    *
    */ 
    public function index()
    {
        
        //Creamos el objeto bodega
        $bodega=new Bodega($this->conexion);
        //Conseguimos todos los bodegas
        $bodegas=$bodega->getAll();
       
        //Cargamos la vista index y le pasamos valores
        $this->view("index",array(
            "bodegas"=>$bodegas,
            "titulo" => "PHP bodega"
        ));
    }
    
   /**
    * Crea un nuevo empleado a partir de los parámetros POST 
    * y vuelve a cargar el index.php.
    *
    */
    public function crear()
    {
        if(isset($_POST["nombre"])){
            
            //Creamos un usuario
            $bodega=new Bodega($this->conexion);
            $bodega->setNombre($_POST["nombre"]);
            $bodega->setDireccion($_POST["direccion"]);
            $bodega->setEmail($_POST["email"]);
            $bodega->setTelefono($_POST["telefono"]);
            $bodega->setEncargadoS($_POST['encargadoS']);
            $bodega->setFechaF($_POST['fechaF']);
            $bodega->setRestaurante($_POST['restaurante']);
            $bodega->setHotel($_POST['hotel']);
            $save=$bodega->save();
        }
        header('Location: index.php');
    }
    
    public function crearV()
    {
        if(isset($_POST["nombre"])){
            
            
            $vino=new Vino($this->conexion);
            $vino->setNombre($_POST["nombre"]);
            $vino->setDescripcion($_POST["descripcion"]);
            $vino->setAño($_POST["año"]);
            $vino->setAlcohol($_POST["alcohol"]);
            $vino->setBodega($_POST['bodega']); 
            $save=$vino->save();
            
        }
        header('Location: index.php');
    }
    
    public function updateV()
    {
        if(isset($_POST["nombre"])){
            
            
            $vino=new Vino($this->conexion);
            $vino->setId($_POST['id']);
            $vino->setNombre($_POST["nombre"]);
            $vino->setDescripcion($_POST["descripcion"]);
            $vino->setAño($_POST["año"]);
            $vino->setAlcohol($_POST["alcohol"]);
            $vino->setBodega($_POST['bodega']); 
            $save=$vino->update();
            
        }
        header('Location: index.php');
    }
    
    public function update() 
    {
        if(isset($_POST["nombre"])){
            
  
            $bodega=new Bodega($this->conexion);
            $bodega->setId($_POST["id"]);
            $bodega->setNombre($_POST["nombre"]);
            $bodega->setDireccion($_POST["direccion"]);
            $bodega->setEmail($_POST["email"]);
            $bodega->setTelefono($_POST["telefono"]);
            $bodega->setEncargadoS($_POST['encargadoS']);
            $bodega->setFechaF($_POST['fechaF']);
            $bodega->setRestaurante($_POST['restaurante']);
            $bodega->setHotel($_POST['hotel']);         
            $save=$bodega->update();
        }
        
        header('Location: index.php');
    }
    public function detalle()
    {
        $bodega=new Bodega($this->conexion); 
        $vino=new Vino($this->conexion);
        $bodegas=$bodega->getBodega($_GET["id"]);
        $vinos=$vino->getAll($_GET["id"]);
        $this->view2('bodega',array(
            "bodegas"=>$bodegas,"vinos"=>$vinos));
        
        

    }
    
    public function borrar()
    {
        $bodega=new Bodega($this->conexion); 
        $vino=new Vino($this->conexion);
        $vino->deleteB($_GET["id"]);
        $bodega->delete($_GET["id"]);
        
        header('Location: index.php');
    }
    
    public function borrarV()
    {
        $vino=new Vino($this->conexion);
        $vino->delete($_GET["id"]);
        
        header('Location: index.php');
    }
    
    public function vinosV() {
        $bodega=new Bodega($this->conexion); 
        $vino=new Vino($this->conexion);
        $bodegas=$bodega->getBodega($_GET["id"]);
        
        $this->viewV('vino',array(
            "bodegas"=>$bodegas));
        
    }

    public function detalleV() { 
        $vino=new Vino($this->conexion);
        $vinos=$vino->getVino($_GET["id"]);
        
        $this->viewVu('vinou',array(
            "vinos"=>$vinos));
    }
   
    function view($vista,$datos){
        $bodegas = $datos["bodegas"];  
          
        require_once  __DIR__ . "/../view/" . $vista . "View.php";

    }
    
    function view2($vista,$datos){
        $bodegas = $datos["bodegas"];  
        $vinos=$datos["vinos"];
          
        require_once  __DIR__ . "/../view/" . $vista . "View.php";

    }
    
    function viewV($vista,$datos){
        $bodegas = $datos["bodegas"];  

        require_once  __DIR__ . "/../view/" . $vista . "View.php";

    }
    
    function viewVu($vista,$datos){
        $vinos = $datos["vinos"];   
        require_once  __DIR__ . "/../view/" . $vista . "View.php";

    }
    

    public function volver() 
    {
        header('Location: index.php');
    }

    

}
?>
