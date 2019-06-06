<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setupfile {

  function send($number, $message)
  {
    $ci = & get_instance();
    $data=array(
                  "username"=>'asimsbbm@gmail.com',
                  "hash"=>'abdd277d1be1890409af423c45c359ba0d95890ce35b2314c708280550dd60d7',
                  'apikey'=>false);
    $sender  = "PBSBBM";
   // $numbers = array($number);
    $ci->load->library('textlocal',$data);
    $response = $ci->textlocal->sendSms($number, $message, $sender);
    return $response;
  }


  function getbalance()
  {
    $ci = & get_instance();
    $data=array(
                  "username"=>'asimsbbm@gmail.com',
                  "hash"=>'abdd277d1be1890409af423c45c359ba0d95890ce35b2314c708280550dd60d7',
                  'apikey'=>false);
    $sender  = "PBSBBM";
   // $numbers = array($number);
    $ci->load->library('textlocal',$data);
    $response = $ci->textlocal->getBalance();;
    return $response;
  }


  function getMessageStatus($batchid)
  {
    $ci = & get_instance();
    $data=array(
                  "username"=>'asimsbbm@gmail.com',
                  "hash"=>'abdd277d1be1890409af423c45c359ba0d95890ce35b2314c708280550dd60d7',
                  'apikey'=>false);
    $sender  = "PBSBBM";
   // $numbers = array($number);
    $ci->load->library('textlocal',$data);
    $response = $ci->textlocal->getMessageStatus($batchid);
    return $response;
  }






}




