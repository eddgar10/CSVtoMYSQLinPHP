<!-- Importar un archivo CSV a MySQL utilizando PHP
https://programacion.net/articulo/importar_un_archivo_csv_a_mysql_utilizando_php_1882
 -->

<!--EL EJEMPLO FUNCIONA BAJO ESTA BASE DE DATOS QUE SE CREA PREVIAMENTE EN PHPMYADMIN
    *ESTO DEBE GENERARSE EN UN PHP INDEPENDIENTE AL EJECUTAR EL BOTON DESCAR DEL FORMULARIO ORIGINAL


CREATE DATABASE emp;
CREATE TABLE IF NOT EXISTS `emp` (
`emp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
`emp_name` varchar(255) NOT NULL COMMENT 'employee name',
`emp_email` varchar(100) NOT NULL,
`emp_salary` double NOT NULL COMMENT 'employee salary',
`emp_age` int(11) NOT NULL COMMENT 'employee age',
PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

DE IGUAL MANERA SE DEBE INCORPORAR LOS MODULOS DE LA CARPETA 'mysql-csv' BASADO EN EL SIGUIENTE ENLACE: https://programacion.net/articulo/como_exportar_datos_a_un_fichero_csv_mediante_php_y_mysql_1887
-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<div class="container">
    <div class="panel panel-default">
    <div class="panel-body">
    <br>
        <!--SE ELIE EL ARCHIVO CSV A IMPORTAR A SQL LLAMANDO A FUNCION IMPORT.PHP-->
    <div class="row">
        <form action="import.php" method="post" enctype="multipart/form-data" id="import_form">
            <div class="col-md-4">
            <input type="file" name="file" />
            <br>
                    <!--  <input type="text" class="form-control" name="namebd" id="inputText3" placeholder="nombre de base madre" required> -->
            </div>
            <div class="col-md-5">
            <input type="submit" class="btn btn-primary" name="import_data" value="importar a MYSQL">
            </div>
        </form>
    </div>
        
    <br>
        
    <div class="row">
        <table class="table table-bordered">
            <!--COLUMNAS DE LA BASE A DESPLEGAR-->
            <thead>
                <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Edad</th>
                <th>Salario($)</th>
                </tr>
            </thead>    
            
            <!--LLAMADO A LA BD LLENADA CON DATOS DEL ARCHIVO CVS, PUEDE INCLUIRSE EN OTRO PHP INDEPENDIENTE-->
            <tbody>
                <?php
                   
                include __DIR__ . '/db_connect.php';
                
                

                $sql = "SELECT * FROM emp";
                $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
                if(mysqli_num_rows($resultset)) {
                while( $rows = mysqli_fetch_assoc($resultset) ) {
                ?>
            <tr>
            <td><?php echo $rows['emp_id']; ?></td>
            <td><?php echo $rows['emp_name']; ?></td>
            <td><?php echo $rows['emp_email']; ?></td>
            <td><?php echo $rows['emp_age']; ?></td>
            <td><?php echo $rows['emp_salary']; ?></td>

            </tr>
                <?php } } else { ?>
                <tr><td colspan="10">Sin información para mostrar</td></tr>
                <?php }
                
                ?>
            </tbody>
            
        </table>
    </div>
    </div>
    </div>
</div>