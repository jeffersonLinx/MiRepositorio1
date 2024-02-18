<?php
session_start(); // para iniciar la sesión

require('fpdf/fpdf.php'); // ruta de acuerdo a structura de carpetas
require('funciones.php'); // Ajusta la ruta según donde al archivo funciones.php

class PDF extends FPDF
{
    function Header()
    {    
    $this->setY(12);
    $this->setX(10);  
    $this->Image('img/logoPDF2.png',25,5,45);   
    $this->SetFont('times', 'B', 13);
    $this->Text(75, 15, utf8_decode('NOMBRE EMPRESA AUTOCAR'));  
    $this->Text(77, 21, utf8_decode('6Anillo, AV. cotoca, los tajivos'));
    $this->Text(88,27, utf8_decode('Tel: 7000-600-20'));
    $this->Text(78,33, utf8_decode('autocar@gamail.com'));
    $this->Image('img/logoPDF2.png',160,5,45); 
    //información de # de factura
// Genera un número de factura único
    $numeroFactura = uniqid();
// Establece el formato de la fuente y muestra el número de factura
    $this->SetFont('Arial', 'B', 10);   
    $this->Text(150, 48, utf8_decode('FACTURA N°:'));
    $this->SetFont('Arial', '', 10);  
    $this->Text(176, 48, $numeroFactura);

    // Agregamos los datos del cliente
    $this->SetFont('Arial','B',10);    
    $this->Text(10,48, utf8_decode('Fecha:'));
    $this->SetFont('Arial','',10);    
    $this->Text(25,48, date('d/m/Y'));   
    // Agregamos los datos de la factura
    // $this->SetFont('Arial','B',10);    
    // $this->Text(10,54, utf8_decode('Cliente:'));
    // $this->SetFont('Arial','',10);    
    // $this->Text(25,54, 'Tommy Shelby ');    
    // $this->Ln(50);

    // Obtener el nombre del usuario desde la variable de sesión

// Obtener el nombre del usuario desde la variable de sesión
$nombreUsuarioFactura = isset($_SESSION['nombreUsuarioFactura']) ? $_SESSION['nombreUsuarioFactura'] : '';

// Resto del código...
$this->SetFont('Arial','B',10);    
$this->Text(10, 54, utf8_decode('Cliente:'));
$this->SetFont('Arial','',10);    
$this->Text(25, 54, $nombreUsuarioFactura);  // Utiliza el nombre del usuario obtenido
$this->Ln(50);

    }


    
//footer 
    function Footer()
    {
        // Pie de página

        $this->SetFont('helvetica', 'B', 8);
        $this->SetY(-15);
        $this->Cell(95,5,utf8_decode('Página ').$this->PageNo().' / {nb}',0,0,'L');
        $this->Cell(95,5,date('d/m/Y | g:i:a') ,00,1,'R');
        $this->Line(10,287,200,287);
        $this->Cell(0,5,utf8_decode("autocar © Todos los derechos reservados."),0,0,"C");
        
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);
$pdf->SetAutoPageBreak(true,20);//salto de pagina automatico
// Detalles de la factura
$pdf->SetFont('Arial', 'B', 12);// encabezado

if (isset($_SESSION['lista']) && is_array($_SESSION['lista'])) {
    $total = calcularTotalLista($_SESSION['lista']);

    $pdf->Cell(30, 10, 'Codigo', 1);
    $pdf->Cell(75, 10, 'Producto', 1);
    $pdf->Cell(30, 10, 'Precio', 1);
    $pdf->Cell(30, 10, 'Cantidad', 1);
    $pdf->Cell(30, 10, 'Subtotal', 1);
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 12);// detalle encabezado
    foreach ($_SESSION['lista'] as $lista) {
        $pdf->Cell(30, 10, $lista->codigo, 1);
        $pdf->Cell(75, 10, $lista->nombre, 1);
        $pdf->Cell(30, 10, '$' . $lista->venta, 1);
        $pdf->Cell(30, 10, $lista->cantidad, 1);
        $pdf->Cell(30, 10, '$' . floatval($lista->cantidad * $lista->venta), 1);
        $pdf->Ln();
    }

    // Total
    $pdf->Ln(10);
    $pdf->Cell(195, 10, 'Total: $' . $total, 1, 0, 'R');
} else {
    $pdf->Cell(0, 10, 'No hay productos en la lista.', 1, 1, 'C');
}
// //cliente
// $clienteSeleccionado = (isset($_SESSION['clienteVenta'])) ? obtenerClientePorId($_SESSION['clienteVenta']) : null;
// if ($clienteSeleccionado) {
//     $this->Cell(0, 10, 'Cliente: ' . $clienteSeleccionado->nombre, 0, 1, 'C');
// }

// $this->Ln(10);
// $this->Image('img\logoPDF2.png', 165, -5, 45);
// $this->Image('img/logo.png', -1, -1, 40);


// Mostrar el PDF
$pdf->Output();
?>
