<?php
require APPPATH.'third_party/tcpdf_min/tcpdf.php';
class MYPDF extends TCPDF
{

  //Page header
  public function Header()
  {
    $html = $this->CustomHeaderText;
    if ($this->page == 1) {
      $this->writeHTML($html, true, false, false, false, '');
      $this->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
    } else {
      $this->writeHTML($html, true, false, false, false, '');
      $this->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
    }
  }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$headerTxt = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<table sytle="width:100%" border="1px" style="collapse:collapse;" cellspacing="0" cellpadding="0">
        <tr>
          <td style="width:60%;" align="center" colspan="2">
            ID FAKTUR '.$faktur[0]->id_faktur.'
          </td>
        </tr>
        <tr>
          <td align="center" style="width:20%;">
          <br/>
          <br/>
            <img src="@'.base64_encode(file_get_contents(FCPATH . $faktur[0]->qrcode_faktur)).'" style="width:60px;">
          </td>
          <td align="center" style="width:40%;">
          <br/>
          <br/>
            <img src="@'.base64_encode(file_get_contents(FCPATH . $faktur[0]->barcode_faktur)).'" style="width:80px;">
          </td>
        </tr>
</table>';

$pdf->CustomHeaderText = $headerTxt;
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

$dataBarang = '';
$dataBarang .= '<table border="1px" style="collapse:collapse;" style="width:100%">
                <thead>
                  <tr>
                    <th width="8%">No</th>
                    <th width="23%">Kode Inventori</th>
                    <th width="20%">Nama Inventori</th>
                    <th width="12%">Nama Unit Awal</th>
                    <th width="12%">Nama Sub Unit Awal</th>
                    <th width="12%">Nama Unit Pindah</th>
                    <th width="13%">Nama Sub Unit Pindah</th>
                  </tr>
                </thead><tbody>';
$no = 1; foreach ($detailFaktur as $key) {
    $dataBarang .= '<tr>
    <td width="8%">'.$no++.'</td>
    <td width="23%">'.$key->kode_inventori.'</td>
    <td width="20%">'.$key->nama_inventori.'</td>
    <td width="12%">'.$key->nama_unit_awal.'</td>
    <td width="12%">'.$key->nama_sub_unit_awal.'</td>
    <td width="12%">'.$key->nama_unit_pindah.'</td>
    <td width="13%">'.$key->nama_sub_unit_pindah.'</td>
    </tr>';
}
  $dataBarang .= '</tbody>';
$dataBarang .= '</table>';


$html = '<hr/><br/><table border="1px" style="collapse:collapse;">
                <tr>
                  <td>Kode Faktur</td>
                  <td>'.$faktur[0]->kode_faktur.'</td>
                </tr>
                <tr>
                  <td>Dibuat Oleh</td>
                  <td>'.$faktur[0]->pembuat_faktur.'</td>
                </tr>
                <tr>
                  <td>Dibuat Pada</td>
                  <td>'.$faktur[0]->created_time.'</td>
                </tr>';
$html.=         '<tr>
                  <td>Catatan Faktur</td>
                  <td>'.$faktur[0]->catatan_faktur.'</td>
                </tr>
                <tr>
                  <td>Tgl Approval</td>
                  <td>'.$faktur[0]->approval_time.'</td>
                </tr>
                <tr>
                  <td>Di approve/reject Oleh</td>
                  <td>'.$faktur[0]->pengaprove_faktur.'</td>
                </tr>';
$html.=     '</table>
              <br/><h3>Data Inventori</h3>'.$dataBarang;
// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
ob_end_clean();
$pdf->Output('Detail_Faktur_Mutasi_'.$faktur[0]->id_faktur.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
