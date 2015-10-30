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
            $param = "('', 'Letter', 0, '', 12.7, 12.7, 14, 12.7, 8, 8)";         
        }
          
        return new mPDF('utf-8', 'Letter');
    }
}
 