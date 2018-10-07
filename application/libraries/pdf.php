
 
<?php
  if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once APPPATH.'/third_party/mpdf/mpdf.php';

class pdf {

    public $param;
    public $pdf;
    public function __construct($param ="'','A4', 0, '', 0, 0, 0, 0, 0, 0")

    {
        $this->param =$param;
        $this->pdf = new mPDF($this->param);
    }
}
?>
    