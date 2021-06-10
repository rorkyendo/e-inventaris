<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('sendMail'))
{
  function sendMail($subject, $mailContent, $mailTo, $mailFromId, $mailFromName)
  {
      $CI =& get_instance();
      $CI->load->library('email');
      $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://mail.medandigitalinnovation.com',
      'smtp_port' => 465,
      'smtp_user' => 'official@medandigitalinnovation.com',
      'smtp_pass' => '1sampai12',
      'mailtype' => 'html', //plaintext 'text' mails or 'html'
      'charset' => 'iso-8859-1'
    );
      $CI->email->set_newline("\r\n");
      $CI->email->initialize($config);
      $CI->email->from('mail.medandigitalinnovation.com', 'Admin');
      $CI->email->to($mailTo);
      $CI->email->subject($subject);
      $CI->email->message($mailContent);
      if($CI->email->send()==TRUE){
          // echo "email berhasil dikirim";
      }else{
          echo "email gagal dikirim";
          echo $CI->email->print_debugger();
      }

  }
}
