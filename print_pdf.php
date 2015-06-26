<?php
include 'db.php';
include 'session.php';
require('fpdf.php');

if (!empty($_GET['ct'])) {
    $ct = $_GET['ct'];
    $query = mysqli_query($link, "SELECT * FROM lists WHERE category_id = $ct");

    class PDF extends FPDF {

        // Page header
        function Header() {
            // Logo
            $this->Image('images/bestof.png', 10, 6, 30);
            // Arial bold 15
            $this->SetFont('Arial', 'B', 15);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(30, 10, 'BestOF', 1, 0, 'C');
            // Line break
            $this->Ln(20);
        }

        // Page footer
        function Footer() {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }

    }

    // Instanciation of inherited class
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times', '', 12);

    while ($list = mysqli_fetch_array($query)) {
        $sentence = $list['title'] . '              (image: http://bestof.vido.si/images/uploads/listings/' . $list['image'] . ')';
        $pdf->Cell(0, 10, $sentence, 0, 1);
    }
    $user_id = $_SESSION['user_id'];
    mysqli_query($link, "INSERT INTO user_logs (user_id, event) VALUES ('$user_id', 'User printed new pdf')");
    $pdf->Output();
} else {
    header('Location: categories.php');
    die();
}
?>