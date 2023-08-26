<?php
session_start();
include ('db.php');
include ("fpdf.php");
if(isset($_SESSION['tid'])){
    $mid = $_SESSION['tid'];
    $rdata = mysqli_query($con, "SELECT home.hcomp,home.sid,home.mclass FROM home where home.tid='$mid' order by home.sid asc");
    if(isset($_POST['dat'])){
      if($_POST['dat'] != "Class" && $_POST['sec']!="sec"){
         $dat = $_POST['dat'];
         $sec = $_POST['sec'];
        $class = "$dat"."-"."$sec";
        $rdata = mysqli_query($con, "SELECT home.hcomp,home.sid,home.mclass FROM home where home.tid='$mid' && home.mclass='$class' order by home.sid asc");
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
        $this->Ln(5);
        $this->SetFont('Arial','B',20);
        $this->SetFillColor(180,180,255);
        $this->SetDrawColor(180,180,255);
        $this->SetLeftMargin(20);
        $this->Cell(25,15,'S. no.',1,0,'',true);
        $this->Cell(80,15,'Name',1,0,'',true);
        $this->Cell(40,15,'Marks',1,0,'',true);
        $this->Cell(25,15,'Class',1,1,'',true);
    }
    function Footer(){
        //add table's bottom line
        $this->SetLeftMargin(20);
        $this->Cell(170,0,'','T',1,'',true);
        //Go to 1.5 cm from bottom
        $this->SetY(-20);
                
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
$pdf->SetLeftMargin(20);
$pdf->SetAutoPageBreak(true,15);
$pdf->AddPage();
$pdf->SetFont('Arial','',20);
$pdf->SetDrawColor(180,180,255);
if(mysqli_num_rows($rdata)){
  $d=0;
while($data=mysqli_fetch_array($rdata)){
    $d=$d+1;
    $pdf->Cell(25,20,$d,'LR',0,'C');
    $pdf->Cell(80,20,$data[1],'LR',0);
    $pdf->Cell(40,20,"$data[0]",'LR',0);
    $pdf->Cell(25,20,$data[2],'LR',1);
}}else{
    $pdf->Cell(20,20,'No data available');
}
$pdf->Output('D',"peakme_hw.pdf");
}
else{header("location:teacher.php");}
?>