<?php 
require_once 'config/init.php';
require_once 'includes/fpdf/fpdf.php'; 


$query="SELECT Artist,Name,Rating,Price FROM playlist order by artist";

$result = $db->query ($query);

$arRows = array();
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				

			array_push($arRows, $row);
	}


class PDF extends FPDF
{


function Header()
{
 
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(40);
    // Title
    $this->Cell(110,10,'Playlist Displayed in PDF from Database',1,0,'C');
    // Line break
    $this->Ln(20);
}

// Colored table
function FancyTable($header, $data)
{
    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(60, 50, 30, 40 );
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],20,$row['Artist'],'LR',0,'L',$fill);
        $this->Cell($w[1],20,$row['Name'],'LR',0,'L',$fill);
        $this->Cell($w[2],20,$row['Rating'],'LR',0,'R',$fill);
        $this->Cell($w[3],20,number_format($row['Price'],2),'LR',0,'R',$fill);
       
  
        $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),10,'','T');
}
}

$pdf = new PDF();

// Column headings
$header = array('Artist', 'Song', 'Rating ', 'Price' );


$data = $arRows;
$pdf->SetFont('Arial','B',16);
$pdf->AddPage();


$pdf->SetFont('Arial','',14);

$pdf->FancyTable($header,$data);
$pdf->Output();






