$user = $this->users->get_user_by_id($this->tank_auth->get_user_id(), TRUE);

if($user->admin == 1){ 
    //this user is admin 
}

$html = $this->load->view('layouts/index', $data, true);	
				//this the the PDF filename that user will get to download
		$pdfFilePath = "the_pdf_output.pdf";

		//load mPDF library
		$this->load->library('m_pdf');
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();
		//generate the PDF!
		$pdf->WriteHTML($html);
		//offer it to user via browser download! (The PDF won't be saved on your server HDD)
		$pdf->Output($pdfFilePath, "D");