<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class M_pdf {
    
    function m_pdf()
    {
        $CI = & get_instance();
     }
 
    function load($param=NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';
         
        if ($params == NULL)
        {
            $param = "('', 'Letter', '', '', 20, 20, 25, 25, 18, 8";         
        }
          
        return new mPDF($param);
    }
}
 