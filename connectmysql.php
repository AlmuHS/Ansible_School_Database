<?php
function OpenCon()
{
        $dbhost = "34.78.37.255";
        $dbuser = "root";
        $dbpass = "usuario";
        $db = "imagenes";
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
        return $conn;
}
function CloseCon($conn)
{
        $conn -> close();
}
$conn = OpenCon();
echo "Connected Successfully <br>";
$resultado = mysqli_query($conn,"SELECT * FROM lista_imagenes");
echo "Consultando base de datos de imagenes" . "<br>";
printf("La selección devolvió %d filas. <br>", $resultado->num_rows);

$image_sel = "";

if (isset($_POST['consultar'])) {
         $image_sel = $_POST["image"];
         
         echo "$image_sel";
         
         $query = "SELECT ruta FROM lista_imagenes WHERE nombre = '$image_sel'";
         $resultado2 = mysqli_query($conn,$query);
         $row_ruta = mysqli_fetch_assoc($resultado2);
         echo $row_ruta['ruta'];
         header("Status: 301 Moved Permanently");
         header("Location: {$row_ruta['ruta']}");
}
   
//CloseCon($conn);
?>

<html>
  <br>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  <div id="page" class="container">
  <?php
        $i = 0;
	if (mysqli_num_rows($resultado) > 0) {
	    print "<input type=\"submit\" name=\"consultar\" class=\"btn btn-lg btn-primary\" value=\"Mostrar imagen\"><br>";
	    while($row = mysqli_fetch_assoc($resultado)) {
                echo "<input type='radio' name='image' value=\"{$row['nombre']}\">{$row['nombre']}";
                echo "<br>";
                $i++;
            }
	}
   ?>
  </div>
  </form>
</html>

