<?php
function OpenCon()
{
        $dbhost = "10.132.0.13";
        $dbuser = "test_user";
        $dbpass = "test";
        $db = "test_db";
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
        return $conn;
}
function CloseCon($conn)
{
        $conn -> close();
}
$conn = OpenCon();
echo "Connected Successfully <br>";

$tipo_usr = "";

if (isset($_POST['consultar'])) {
         $tipo_usr = $_POST["tipo_usuario"];

         if($tipo_usr != ""){
                $tipo_upper = strtoupper($tipo_usr);
                  
                $query = "SELECT * FROM USUARIOS INNER JOIN $tipo_upper ON(USUARIOS.ID = $tipo_upper.ID)";
                
                $resultado = mysqli_query($conn,$query);

                print("Los $tipo_usr registrados en la base de datos son: ");
                while($row = mysqli_fetch_assoc($resultado)) {
                        print("{$row['nombre']}, ");
                }
         }
}
   
//CloseCon($conn);
?>

<html>
<body>
  <div>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 
        <div id="page" class="container">
        Tipo de Usuario:
	<input type="radio" name="tipo_usuario"
	value="alumnos">Alumnos
	<input type="radio" name="tipo_usuario"
	value="profesores">Profesores
	</div>
        <input type="text" id="nombre" name="nombre" maxlength="50" size="20">

        <input type="submit" name="consultar" value="consultar" />
  </div>
  </form>
</body>
</html>

