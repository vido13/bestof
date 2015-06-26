<?php

include 'db.php';
require('fpdf.php');

if (!empty($_GET['list'])) {
    $list = $_GET['list'];
    $query = mysqli_query($link, "SELECT * FROM lists WHERE id = $list");
    $list = mysqli_fetch_array($query);

    $title = $list['title'];
    $description = $list['description'];
    $date = $list['date'];
    $image = "images/uploads/listings/".$list['image'];

    $pdf = new FPDF();
    //var_dump(get_class_methods($pdf));
    $pdf->AddPage();
    $pdf->SetFont("Arial", "", "14");
    $pdf->Cell(0, 10, "$title\n - $date", 1, 1, "C");
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', "10");
    $pdf->Write(5, "$description");
    $pdf->Ln(10);
    $pdf->Image('' . "$image" . '', 50);
    $pdf->Output();
} else {
    header('Location: categories.php');
    die();
}
?>
