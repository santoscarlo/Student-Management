<?php
include('fpdf.php');
$db = new PDO('mysql:host=localhost;dbname=info_db','root','');

class myPDF extends FPDF
{
// Page header
function Header()
{


    // Logo
 $size="150";  //(min 0, max 210; it's for making image big or small,
      $absx=(280-$size)/2;

    $this->Image('img/sample.png',$absx,5,$size);
   $this->Ln(40);

// HEADER TITLE
    $this->SetFont('Times','B',15);
    $this->CELL(0,0,'BSIT STUDENTS LIST',0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',12);
    $this->Cell(0,14,'Students and Visitors Monitoring System',0,0,'C');
    $this->Ln(5);
 

 
// FOR DATE
        $this->SetX(50);
        $this->SetFont('Arial', 'I', 12);
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
 $this->Cell(15,10,'ID',1,0,'C');
 $this->Cell(45,10,'Student Number',1,0,'C');
 $this->Cell(62,10,'Student Name',1,0,'C');
 $this->Cell(28,10,'Gender',1,0,'C');
 $this->Cell(45,10,'Section',1,0,'C');
 $this->Cell(28,10,'Course',1,0,'C');
 $this->Cell(58,10,'Year Level',1,0,'C');
 $this->Ln();

}
function viewTable($db){
    $this->SetFont('Times','',12);
    $stmt = $db->query('SELECT * from studenttable WHERE course = "BSIT" order by lastname ASC ');
    while($data = $stmt->fetch(PDO::FETCH_OBJ)){
    $this->Cell(15,10,$data->id,1,0,'L');
    $this->Cell(45,10,$data->StudID,1,0,'L');
    $this->Cell(62,10,$data->lastname.', '.$data->firstname.' '.$data->middlename,1,0,'L');
    $this->Cell(28,10,$data->gender,1,0,'L');
     $this->Cell(45,10,$data->section,1,0,'L');
     $this->Cell(28,10,$data->course,1,0,'L');
    $this->Cell(58,10,$data->yearlevel,1,0,'L');
    
    $this->Ln(10);

  }
// TOTAL RECORD COUNT
          $conn=mysqli_connect("localhost","root","","info_db");
          // Check connection
          if (mysqli_connect_errno())
          {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }
          $sql="SELECT count(*) from studenttable WHERE course = 'BSIT'";
          $result=mysqli_query($conn,$sql);
          $row=mysqli_fetch_array($result);
          // echo "$row[0]";
                 $this->SetFont('Times','B',12);
                 $this->Cell(281,12, 'Total BSIT Students: '.$row[0] ,True, 'L',0);
          mysqli_close($conn);
}

}

// Instanciation of inherited class

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L'); // LANDSCAPE PRINT
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->SetFont('Times','',12);
//for($i=1;$i<=40;$i++)
    //$pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();