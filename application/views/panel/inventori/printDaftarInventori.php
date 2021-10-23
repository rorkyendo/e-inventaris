<?php
require APPPATH.'third_party/tcpdf_min/tcpdf.php';
class MYPDF extends TCPDF
{

    public function Header()
    {
      $html = $this->CustomHeaderText;
      if (!empty($this->id_kategori) || (!empty($this->kode_unit) || !empty($this->kode_sub_unit))) {
        $margin = 20;
      }else{
        $margin = 10;
      }
      if ($this->page == 1) {
        $this->writeHTML($html, true, false, false, false, '');
        $this->SetMargins(PDF_MARGIN_LEFT, $margin, PDF_MARGIN_RIGHT);
      } else {
        $this->writeHTML($html, true, false, false, false, '');
        $this->SetMargins(PDF_MARGIN_LEFT, $margin, PDF_MARGIN_RIGHT);
      }
    }
    
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$headerTxt = '
<table sytle="width:100%" border="1px" style="collapse:collapse;" cellspacing="0" cellpadding="0">';
if (!empty($id_kategori)) {
$headerTxt .=  '<tr>
  <td>Kategori Inventori</td>
  <td>'.$inventori[0]->nama_inventori.'</td>
  </tr>';
}
if (!empty($kode_unit)) {
$headerTxt .=  '<tr>
  <td>Nama Unit</td>
  <td>'.$inventori[0]->nama_unit.'</td>
  </tr>';
}
if (!empty($kode_sub_unit)) {
$headerTxt .=  '<tr>
  <td>Nama Sub Unit</td>
  <td>'.$inventori[0]->nama_sub_unit.'</td>
  </tr>';
}
$headerTxt .= '</table>';
$pdf->CustomHeaderText = $headerTxt;
$pdf->id_kategori = $id_kategori;
$pdf->kode_unit = $kode_unit;
$pdf->kode_sub_unit = $kode_sub_unit;
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->SetFont('helvetica', '', 12);

$pdf->AddPage();

// set text shadow effect
// $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

$daftarInventori = '';
foreach ($inventori as $key) {
  $daftarInventori .= '<tr>';
    $daftarInventori .= '<td width="20%" style="font-size:12px;">'.$key->kode_inventori.'</td>';
    $daftarInventori .= '<td width="20%" style="font-size:12px;">'.$key->nama_inventori.'</td>';
    $daftarInventori .= '<td width="20%" style="font-size:12px;">'.$key->nama_unit.'</td>';
    $daftarInventori .= '<td width="20%" style="font-size:12px;">'.$key->nama_sub_unit.'</td>';
    $daftarInventori .= '<td width="20%" style="font-size:12px;">'.$key->nama_kategori.'</td>';
  $daftarInventori .= '</tr>';
}


$html = '<hr/><table border="1px" style="collapse:collapse;">
        <thead>
          <tr>
            <th colspan="5" align="center" style="background-color:black;color:white;">Daftar Inventori</th>
          </tr>
          <tr>
            <th width="20%">Kode Inventori</th>
            <th width="20%">Nama Inventori</th>
            <th width="20%">Nama Unit</th>
            <th width="20%">Nama Sub Unit</th>
            <th width="20%">Kategori Inventori</th>
          </tr>
        </thead>
        <tbody>
          '.$daftarInventori.'
        </tdbody>
</table>';

// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
ob_end_clean();
$pdf->Output('Daftar Inventori.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
