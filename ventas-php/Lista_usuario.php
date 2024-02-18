<?php
require('fpdf/fpdf.php'); // Asegúrate de que la ruta sea correcta
require('funciones.php');
// <h1>FIN DE MOODULO</h1>
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->SetFont('times', 'B', 13);
        $this->Cell(0, 10, 'FIN DE MODULO', 0, 1, 'C');
        $this->Cell(0, 9, 'Listado de Usuarios', 0, 1, 'C');
        $this->Image('img/usuarios.png',25,5,35);   
        $this->Image('img/usuarios.png',160,5,35);
         $this->Ln();
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Aquí obtienes la lista de usuarios, por ejemplo desde tu base de datos
$usuarios = obtenerUsuarios();

// Crear instancia de FPDF
$pdf = new PDF();
$pdf->AddPage();

// Cabeceras de tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Usuario', 1);
$pdf->Cell(40, 10, 'Nombre', 1);
$pdf->Cell(40, 10, 'Telefono', 1);
$pdf->Cell(60, 10, 'Direccion', 1);
$pdf->Ln();

// Contenido de tabla
$pdf->SetFont('Arial', '', 12);
foreach ($usuarios as $usuario) {
    $pdf->Cell(40, 10, $usuario->usuario, 1);
    $pdf->Cell(40, 10, $usuario->nombre, 1);
    $pdf->Cell(40, 10, $usuario->telefono, 1);
    $pdf->Cell(60, 10, $usuario->direccion, 1);
    $pdf->Ln();
}

// Mostrar o descargar el PDF según sea necesario
$pdf->Output('Lista_Usuarios.pdf', 'I');
?>
