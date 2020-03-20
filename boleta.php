<?php
    session_start();
    if(!isset($_SESSION['loged'])){
        header('Location: index.php');
    }

      $id_cliente = $_SESSION['rut'];
      if($_SESSION['aux']==0){   
        
        $conexion = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
        if($conexion){
            $procedimiento = 'DECLARE BEGIN trabajo.GENERAR_COMPRA(:ID); END;';
            $stmt = oci_parse($conexion,$procedimiento);
            oci_bind_by_name($stmt,':ID',$id_cliente);
            oci_execute($stmt);
        }
        $_SESSION['aux']=1;       
      }
    $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
          if($c){
            $select = 'SELECT * FROM trabajo.BOLETA WHERE CLIENTE = :p ORDER BY FECHA, HORA';
            $stmt = oci_parse($c, $select);
            oci_bind_by_name($stmt, ":p", $_SESSION["rut"]);
            oci_execute($stmt);
            oci_fetch_all($stmt, $salida);
            $id = $salida["ID_BOLETA"][count($salida["ID_BOLETA"])-1];
            $fecha = $salida["FECHA"][count($salida["ID_BOLETA"])-1];
            $select = 'SELECT * FROM trabajo.DETALLE WHERE ID_BOLETA = :p';
            $stmt = oci_parse($c, $select);
            oci_bind_by_name($stmt, ":p", $id);
            oci_execute($stmt);
            oci_fetch_all($stmt, $salida);
          }
          $tamano = count($_SESSION['asientos_elegidos'] );
?>

<?php
//AddPage(orientation[PORTRAIT, LADSCAPE], tamaño [A3, A4, A5, LETTER, LEGAL]),
//SetFont[tipo(COURIER, HELVETICA, ARIAL, TIMES, SYMBOL, ZAPDINGBATS), estilo[normal, B, I, U], tamaño],
//Cell(ancho, alto, texto, bordes, ?, alineación, rellenar, link)
//OutPut(destino[I, D, F, S], nombre_archivo, utf-8)
require_once('vendor/autoload.php'); // carga las clases autom

require_once('boleta.php');

$css = file_get_contents('css/boleta.css');

$mpdf=new \Mpdf\Mpdf();
$mpdf->Bookmark('Start of the document');

$mpdf->writeHtml($css,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML('<header class="clearfix">
      <div id="logo">
      <img src="logo_negro.png" width="200" height="150">
      </div>
      
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">AERO SKY:</div>
          <div class="email"><a href="aerosky.vuela@ksy.cl">sky.vuela@ksy.cl</a></div>
          <div class="to">¡Haz de tu viaje una experiencia en la que tú decides cómo viajar!</div>
        </div>
        <div id="invoice">
          <h1>AERO SKY</h1>
          <div class="boleta">NUMERO DE BOLETA: '.$id.'</div>
          <div class="date">Fecha:  '.$fecha.'</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="numero">#</th>
            <th class="pasaje">PASAJE</th>
            <th class="tarifa">TARIFA</th>
            <th class="precio">PRECIO PASAJE</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>');
  $mpdf->WriteHTML('<tbody>');
$subtotal = 0;
for ($i=0; $i < count($salida["ID_BOLETA"]); $i++) { 
  $subtotal += (int)$salida["TOTAL_DETALLE"][$i];
  $i2 = $i+1;
  $mpdf->WriteHTML('<tr>');
  $mpdf->WriteHTML('<td>'.$i2.'</td>');
  $mpdf->writeHtml('<td> '.$salida["PASAJE"][$i].'</td>');
  $mpdf->writeHtml('<td> '.$salida["PRECIO_TARIFA"][$i].'</td>');
  $mpdf->writeHtml('<td> '.$salida["PRECIO_PASAJE"][$i].'</td>');
  $mpdf->writeHtml('<td> '.$salida["TOTAL_DETALLE"][$i].'</td>');
  $mpdf->WriteHTML('</tr>');
}
$mpdf->writeHtml('</tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>'.$subtotal.'</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">Multa 20%</td>
            <td>0</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TOTAL FINAL</td>
            <td>'.$subtotal.'</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">¡Buen viaje!</div>
      <div id="notices">
        <div>IMPORTANTE:</div>
        <div class="notice">No hay devolución, si desea podrá realizar un cambio en el itinerario de su viaje pero se le aplicará una multa del 20% en el total de su boleta.</div>
      </div>
    </main>
    <footer>
      ¡Haz de tu viaje una experiencia en la que tú decides cómo viajar!
    </footer>');

    

for ($j=0; $j < $tamano ; $j++){

  $mpdf->AddPage();
  
  $mpdf->writeHtml('<header class="clearfix">
                      <div id="logo">
                      <img src="logo_blanco.png" width="200" height="150" right= "900">
                    </div>
                    </header>'); 
  $mpdf->writeHtml('<h4 style="margin-top: 5px;margin-left: 9px;color: #0D5853;transform: scale(1.1);">Id del pasaje:  ' .$_SESSION['datos_pasajes'][$j][0].'
                </h4>');
  $mpdf->writeHtml('<h4 style="margin-top: 5px;margin-left: 9px;color: #0D5853;transform: scale(1.1);">Nombre del pasajero:  ' .$_SESSION['datos_pasajes'][$j][1].'
                </h4>');
  $mpdf->writeHtml('<h4 style="margin-top: 5px;margin-left: 9px;color: #0D5853;transform: scale(1.1);">N° de documento:  ' .$_SESSION['datos_pasajes'][$j][2].'
                </h4>');
  $mpdf->writeHtml('<h4 style="margin-top: 5px;margin-left: 9px;color: #0D5853;transform: scale(1.1);">Asiento:   ' .$_SESSION['datos_pasajes'][$j][3].'
                </h4>');
  $mpdf->writeHtml('<h4 style="margin-top: 5px;margin-left: 9px;color: #0D5853;transform: scale(1.1);">Origen:   ' .$_SESSION['datos_pasajes'][$j][4].'
                </h4>');
  $mpdf->writeHtml('<h4 style="margin-top: 5px;margin-left: 9px;color: #0D5853;transform: scale(1.1);">Destino:   ' .$_SESSION['datos_pasajes'][$j][5].'
                </h4>');
  $mpdf->writeHtml('<h4 style="margin-top: 5px;margin-left: 9px;color: #0D5853;transform: scale(1.1);">Fecha de salida:   ' .$_SESSION['datos_pasajes'][$j][6].'
                </h4>');
  $mpdf->writeHtml('<h4 style="margin-top: 5px;margin-left: 9px;color: #0D5853;transform: scale(1.1);">Fecha de llegada:   ' .$_SESSION['datos_pasajes'][$j][7].'
                </h4>');
  $mpdf->writeHtml('<h4 style="margin-top: 5px;margin-left: 9px;color: #0D5853;transform: scale(1.1);">N° de vuelo:   ' .$_SESSION['datos_pasajes'][$j][8].'
                </h4>');
  $mpdf->writeHtml('<h4 style="margin-top: 5px;margin-left: 9px;color: #0D5853;transform: scale(1.1);">Tarifa:   ' .$_SESSION['datos_pasajes'][$j][9].'
                </h4> <hr>');
  $mpdf->writeHtml('<footer>
      ¡Haz de tu viaje una experiencia en la que tú decides cómo viajar!
    </footer>');
}
 //permite poner codigo html
$mpdf->Output();
?>

