<?php
session_start();
include ('db.php');
include ("fpdf.php");
if(isset($_SESSION['tid'])){
    $mid = $_SESSION['tid'];
    $rdata = mysqli_query($con, "SELECT * from marks where mtid='$mid' order by mname,mdate asc");
    if(isset($_POST['dat'])){
      if($_POST['dat'] != ""){
        $dat = $_POST['dat'];
        $rdata = mysqli_query($con, "SELECT * from marks where mtid='$mid' && mdate='$dat' order by mname,mdate asc");
      }
    }
class PDF extends FPDF {
    function Header(){
        $this->SetFont('Arial','B',26);
        
if(isset($_POST['label'])){
  if($_POST['label'] != ""){
  $label=$_POST['label'];
  $this->Cell(0,0,$label,0,1,'C');
}}
        //dummy cell to give line spacing
        //$this->Cell(0,5,'',0,1);
        //is equivalent to:
        $this->Ln(5);
        $this->SetFont('Arial','B',20);
        $this->SetFillColor(180,180,255);
        $this->SetDrawColor(180,180,255);
        $this->Cell(20,15,'S. no.',1,0,'',true);
        $this->Cell(25,15,'Id',1,0,'',true);
        $this->Cell(80,15,'Name',1,0,'',true);
        $this->Cell(25,15,'Marks',1,0,'',true);
        $this->Cell(45,15,'Date',1,1,'',true);
    }
    function Footer(){
        //add table's bottom line
        $this->Cell(195,0,'','T',1,'',true);
        
        //Go to 1.5 cm from bottom
        $this->SetY(-15);
                
        $this->SetFont('Arial','',8);
        
        //width = 0 means the cell is extended up to the right margin
        $this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
    }
}


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm
$pdf = new PDF('P','mm','A4'); //use new class
//define new alias for total page numbers
$pdf->AliasNbPages('{pages}');
$pdf->SetAutoPageBreak(true,15);
$pdf->AddPage();
$pdf->SetFont('Arial','',20);
$pdf->SetDrawColor(180,180,255);
if(mysqli_num_rows($rdata)){
  $d=0;
while($data=mysqli_fetch_array($rdata)){
    $d=$d+1;
    $pdf->Cell(20,20,$d,'LR',0);
    $pdf->Cell(25,20,$data[1],'LR',0);
    $pdf->Cell(80,20,$data[2],'LR',0);
    $pdf->Cell(25,20,$data[3],'LR',0);
    $pdf->Cell(45,20,$data[4],'LR',1);
}}else{
    $pdf->Cell(20,20,'No data available');
}
$pdf->Output('D',"peakme_exam.pdf");
}
else{header("location:teacher.php");}
?>