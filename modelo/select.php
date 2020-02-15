<?php
    function obtenerDepartamentos() {
        include '../assets/db/db.php';

        $query = "SELECT * FROM ubdepartamento";
        $result = mysqli_query($connection, $query);

        $json = array();
        
        while($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'codDepartamento' => $row['idDepa'],
                'nomDepartamento' => $row['departamento'],
            );
        }  

        $jsonstring = json_encode($json);
        echo $jsonstring;
    }

    function obtenerProvincias($codDepartamento) {
        include '../assets/db/db.php';

        $query = "SELECT * FROM ubprovincia WHERE idDepa = $codDepartamento";
        $result = mysqli_query($connection, $query);

        $json = array();
        
        while($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'codProvincia' => $row['idProv'],
                'nomProvincia' => $row['provincia'],
            );
        }

        $jsonstring = json_encode($json);
        echo $jsonstring;
    }

    function obtenerDistritos($codProvincia) {
        include '../assets/db/db.php';

        $query = "SELECT * FROM ubdistrito WHERE idProv = $codProvincia";
        $result = mysqli_query($connection, $query);

        $json = array();
        
        while($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'codDistrito' => $row['idDist'],
                'nomDistrito' => $row['distrito'],
            );
        }  

        $jsonstring = json_encode($json);
        echo $jsonstring;
    }

    if( isset($_POST['codigoDepar']) ) {
        $codDepartamento = $_POST['codigoDepar'];
        obtenerProvincias($codDepartamento);
    } else if( isset($_POST['codigoProv']) ) {
        $codProvincia = $_POST['codigoProv'];
        obtenerDistritos($codProvincia);
    } else {
        obtenerDepartamentos();
    }
?>