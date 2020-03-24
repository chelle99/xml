<?php 
      require_once('codigos/conexion.inc');
      
 ?>     
<!DOCTYPE html>
<html lang="en">
<head>
	<?php
        include_once("segmentos/encabe.inc");
        
	?>
	
    <meta http-equiv="refresh" content="180;url=codigos/salir.php">
    <!-- <meta http-equiv="refresh" content="180;url=login.php"> -->
    <title>Empleados</title>
    <script>
       function inscateg(){
			location.href="inscateg.php"; 
		}
    </script>
    
</head>
<body class="container">
	<header class="row">
		<?php
			include_once("segmentos/menu.inc");
		?>
	</header>

	<main class="row">
		<h3>Empleados</h3>
        <div class="panel-body">
           <?php $codigo = ""; ?>
                 <form method="post" enctype="multipart/form-data"
                    name="formita" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                      <table class="table table-bordered">
                      	<tr>
                           <td><strong>Codigo-Departamento</strong></td>
                           <td><input type="text" name="coddep" size="50" value="" maxlength="50"></td>
                           
                        </tr>
                        <tr>
                           <td><strong>Codigo-Empleado</strong></td>
                           <td><input type="text" name="codemp" size="50" value="" maxlength="50"></td>
                           
                        </tr>
                        <tr>
                           <td><strong>Aumento Propuesto</strong></td>
                           <td><input type="text" name="salprop" size="50" value="" maxlength="50"></td>
                           
                        </tr>
                        <tr>
                             <td colspan="2">
                             <?php echo	"<input type='submit' href='repsal.php?cod=$codigo value='Aceptar'>"; ?>
                             </td>
                         </tr>
                      </table>
                      <input type="hidden" name="OC_Modi" value="formita">
                    </form>   
                <?php
                if(isset($_POST["OC_Modi"])){
                    $coddepa = $_POST['coddep'];
                    $salpropu = $_POST['salprop'];
                    $codemp = $_POST['codemp'];
                    header("Location: reportexml.php?cod=$codemp&dep=$coddepa");
                  }
                ?>              
               	</div> 
        
	</main>

	<footer class="row pie">
		<?php
			include_once("segmentos/pie.inc");
		?>
	</footer>

	<!-- jQuery necesario para los efectos de bootstrap -->
    <script src="formatos/bootstrap/js/jquery-1.11.3.min.js"></script>
    <script src="formatos/bootstrap/js/bootstrap.js"></script>
</body>
</html>
