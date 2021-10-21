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
            '.$inventori[0]->keterangan_sumber_dana.'
          </td>
        </tr>
        <tr>
          <td align="center" style="width:20%;">
          <br/>
          <br/>
            <img src="@'.base64_encode(file_get_contents(FCPATH . $inventori[0]->qrcode)).'" style="width:70px;">
          </td>
          <td align="center" style="width:40%;">
          <br/>
          <br/>
            <img src="@'.base64_encode(file_get_contents(FCPATH . $inventori[0]->barcode)).'" style="width:160px;">
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

$html = '<hr/><table border="1px" style="collapse:collapse;">
                <tr>
                  <td align="center" colspan="2">
                    <br/>
                    <br/>
                    <img src="@'.base64_encode(file_get_contents(FCPATH . $inventori[0]->foto_inventori)).'" style="width:160px;">
                  </td>
                </tr>
                <tr>
                  <td>Nama Unit</td>
                  <td>'.$inventori[0]->nama_unit.'</td>
                </tr>
                <tr>
                  <td>Nama Sub Unit</td>
                  <td>'.$inventori[0]->nama_sub_unit.'</td>
                </tr>
                <tr>
                  <td>Keterangan Sub Unit</td>
                  <td>'.$inventori[0]->keterangan_sub_unit.'</td>
                </tr>
                <tr>
                  <td>Nama Inventori</td>
                  <td>'.$inventori[0]->nama_inventori.'</td>
                </tr>
                <tr>
                  <td>Harga Inventori</td>
                  <td>Rp '.number_format($inventori[0]->harga_barang,0,'.','.').'</td>
                </tr>
        </table>';

// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
ob_end_clean();
$pdf->Output('Inventori '.$inventori[0]->kode_inventori.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
