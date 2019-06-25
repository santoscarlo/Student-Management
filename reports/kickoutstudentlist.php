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
      $absx=(280-$size)/2;

    $this->Image('img/sample.png',$absx,5,$size);
   $this->Ln(40);

// HEADER TITLE
    $this->SetFont('Times','B',15);
    $this->CELL(0,0,'KICKOUT STUDENT LIST',0,0,'C');
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
  $this->Cell(27,10,'Roll No.',1,0,'C');
 $this->Cell(40,10,'Student Number',1,0,'C');
 $this->Cell(50,10,'Student Name',1,0,'C');
  $this->Cell(45,10,'Course',1,0,'C');
 $this->Cell(80,10,'Year Level',1,0,'C');
 $this->Cell(35,10,'Status',1,0,'C');

 $this->Ln();

}
function viewTable($db){
    $this->SetFont('Times','',12);
    $stmt = $db->query('SELECT * from studenttable WHERE statusofstud IN ("Kickout")order by lastname ASC ');
       while($data = $stmt->fetch(PDO::FETCH_OBJ)){
         $this->Cell(27,10,$data->id,1,0,'L');
       $this->Cell(40,10,$data->StudID,1,0,'L');
       $this->Cell(50,10,$data->lastname.', '.$data->firstname,1,0,'L');
        $this->Cell(45,10,$data->course,1,0,'L');
       $this->Cell(80,10,$data->yearlevel,1,0,'L');
       $this->Cell(35,10,$data->statusofstud,1,0,'L');
   
   

     $this->Ln(10);

  }
// TOTAL RECORD COUNT
          $conn=mysqli_connect("localhost","root","","info_db");
          // Check connection
          if (mysqli_connect_errno())
          {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }
          $sql="SELECT count(*) from studenttable WHERE statusofstud IN ('Kickout')";
          $result=mysqli_query($conn,$sql);
          $row=mysqli_fetch_array($result);
          // echo "$row[0]";
              $this->SetFont('Times','B',12);
             $this->Cell('B',12, 'Total of Kickout Students: '.$row[0] ,True, 'L',0);
          mysqli_close($conn);
}

}

// Instanciation of inherited class

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L');
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->SetFont('Times','',12);
// for($i=1;$i<=40;$i++)
//     $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();