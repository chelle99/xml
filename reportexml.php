<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<title>Crear XML con acceso a datos 1</title>
	</head>	
	<body style="background-color: #FFFFCC; color: #800000">
		<img src="imagenes/encabe.png" alt="" >
		<h2>Crear XML con acceso a datos</h2>
		
		<?php
			//obtiene raiz del sitio
			$ruta = $_SERVER["DOCUMENT_ROOT"]."/Examen_02/";		
			
            $dep = (string)$_GET['dep'];
            //$cod = $_GET['cod'];
			//Hablitia conexion con el motor de MySql.
      		include_once("codigos/conexion.inc");
		
			//define consulta
			//$auxSql = sprintf("select d.dept_name, p.emp_no, e.first_name, t.title, s.salary
            //    from departments d, dept_emp p, employees e, titles t, salaries s
            //    where d.dept_no = 'd008' and
            //          e.emp_no = p.emp_no and
            //          s.emp_no = e.emp_no and
            //          t.emp_no = e.emp_no
			//    order by e.first_name");
			
			$auxSql = sprintf("select d.dept_no, d.dept_name, e.emp_no, e.first_name, t.title, s.salary
                from departments d, dept_emp p, employees e, titles t, salaries s
                where d.dept_no = 'd008'                      
                order by e.first_name");

			$Regis = mysqli_query($conex, $auxSql) or die(mysqli_error($conex));

			
			//crea vector de datos
			$i = 0;
			while($fila = mysqli_fetch_array($Regis)){
                $dept[$i] = $fila["dept_no"];
                $deptname[$j] = $fila["dept_name"];
                $codemp[$i] = $fila["emp_no"];
                $nomemp[$i] = $fila["first_name"];
                $title[$i] = $fila["title"];
				$salary[$i] = $fila["salary"];
				
				$i++;
			}
		
			//libera espacio de la consulta
			mysqli_free_result($Regis);
		
			//impresion de los datos (solo prueba)
			$canti = sizeof($dept);
			for($j=0; $j < $canti; $j++){
				printf("Cod-Departamento: %s<br>Departamento: %s<br>Num-Empleado: %s<br>: %s<br>Nombre: %s<br>Titulo: %s<br>Salario: %s<br>", $dept[$j],$deptname[$j],$codemp[$j],$nomemp[$j],$title[$j],$salary[$j]);
				print("----------------------------------------------------------------------------------<br><br>");
			}
		
			//creacion del documento xml
			$xml = "<?xml version='1.0' encoding='utf-8' ?>";
			$xml .= "<enterprise>";
			$xml .= "   <nombre>Employees</nombre>";
			$xml .= "   <department>Human Resourses</department>";
			$xml .= "   <title>Projection of salary increase</title>";			
            $xml .= "</enterprise>";
            
			for($j=0; $j < $canti; $j++){
				$Datos[$j] = '<Summary>
                                <department>
                                    <name>'.$dept[$j].'</name>
                                    <employees>
                                        <employee>
                                            <emp_no>'.$codemp[$j].'</emp_no>
                                            <name>'.$nomemp[$j].'</name>
                                            <title>'.$title[$j].'</title>
                                            <c_salary>'.$salary[$j].'</c_salary>
                                            <n_salary>'.$nombre[$j].'</n_salary>
                                            <difference>'.$nombre[$j].'</difference>                                    
                                        </employee>
                                    </employees>
                                </department>
                             </Summary>';
		        $xml = $xml.$Datos[$j];
			}//fin del for
			
			//escribir archivo xml
			$ruta = $ruta."reporte.xml";
			
			try{
				$archivo = fopen($ruta,"w+");
				fwrite($archivo,$xml);
				fclose($archivo);
			}catch(Exception $e){
				echo "Error:..".$e->getMessage();
			}	               
		?>	
		
		<a href="reporte.xml">XML Generado</a>
			
	</body>	
</html>