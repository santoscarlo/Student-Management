<?php
include('fpdf.php');
$db = new PDO('mysql:host=localhost;dbname=info_db','root','');

class myPDF extends FPDF
{
// Page header
function Header()
{


// LOGO
    $size="150";  //(min 0, max 210; it's for making image big or small,
    $absx=(175-$size)/2;
    $this->Image('img/sample.png',$absx,5,$size);
   $this->Ln(45);


// HEADER TITLE
    $this->SetFont('Times','B',15);
    $this->CELL(0,0,'ATTENDANCE STATUS LIST OF ABSENT',0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',12);
    $this->Cell(0,14,'Students and Visitors Monitoring System',0,0,'C');
    $this->Ln(15);

 
// FOR DATE
        $this->SetX(50);
        $this->SetFont('Arial', 'I', 10);
        date_default_timezone_set('UTC');
        $Date=date('m-d-Y');
        $this->Cell(0, 5, 'Date: '.$Date, 0, 'R', 0);
        $this->Ln(10);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}


function headerTable(){
  ;
 $this->SetFont('Times','B',12, True, 0);
 $this->Cell(35,10,'Student Number',1,0,'C');
 $this->Cell(50,10,'Student Name',1,0,'C');
 $this->Cell(30,10,'Subject ID',1,0,'C');
  $this->Cell(40,10,'Date',1,0,'C');
  $this->Cell(35,10,'Attendance Status',1,0,'C');
 $this->Ln();

}
function viewTable($db){
    $this->SetFont('Times','',12);
    $stmt = $db->query('SELECT * from attendance_records WHERE attendance_status = "ABSENT" order by lastname ASC ');
       while($data = $stmt->fetch(PDO::FETCH_OBJ)){
       $this->Cell(35,10,$data->studentnumber,1,0,'L');
       $this->Cell(50,10,$data->lastname.', '.$data->firstname,1,0,'L');
       $this->Cell(30,10,$data->SubjID,1,0,'L');
       $this->Cell(40,10,$data->date,1,0,'L');
       $this->Cell(35,10,$data->attendance_status,1,0,'L');
   
     $this->Ln(10);

  }


}
}
// Instanciation of inherited class

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->SetFont('Times','',12);
// for($i=1;$i<=40;$i++)
//     $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();