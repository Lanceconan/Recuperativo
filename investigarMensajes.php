<?php include("header.php"); ?>

<div id="page-wrapper" >            
    <div id="page-inner">     
        <div class="row">                
            <div class="col-md-12">
                <div class="jumbotron">
                    <center>
                    	<h1>Mensajes Encontrados</h1> 
                    </center>                    
                    
                    <p>
                        <?php
                            //require_once('lib/nusoap.php');
                            $wsdl = "http://sebastian.cl/isw-ws/wsISW?wsdl";

                            $parametro = array();
                            $parametro['rut'] = $_POST['rut'];
                            $cliente = new SoapClient($wsdl);
                            $resultado = $cliente->getMensajesPorRut($parametro);

                          // echo "<pre>";
                            //($resultado);
                            //echo "</pre>"; 
                        ?>
                       <?php                
                if($resultado->estadoSalida->codigo==-1){
                    ?>
                    <div class="jumbotron">
                        No existen Mensajes registrados con el Rut Ingresado o Rut Invalido.
                    </div>
                    <?php
                }else{
                    $largo = count($resultado->return);
                    for($i=0;$i<$largo;$i++){
                    ?>
                    <div class="jumbotron">
                        <div class="form-group">
                            <label>Id</label>
                            <input class="form-control" type="text" readonly="true" value=<?php echo $resultado->return[$i]->id ?>>
                            <label>Rut</label>
                            <input class="form-control" type="text" readonly="true" value=<?php echo $resultado->return[$i]->rut ?>>
                            <label>Mensaje</label>
                            <input class="form-control" type="text" readonly="true" value=<?php echo $resultado->return[$i]->mensaje." ".$resultado->return[$i]->accion?>>
                            <label>Fecha</label>
                            <input class="form-control" type="text" readonly="true" value=<?php echo $resultado->return[$i]->fecha ?>>
                        </div>
                    </div>
                <?php
                    }
                }
                ?>
                    </p>                    
                </div>
            </div>
        </div>          
    </div>
</div>

<?php include("footer.php"); ?>