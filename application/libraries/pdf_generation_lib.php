<?php
class Pdf_generation_lib {
    
	function pdf_create($html, $filename, $stream=false) 
	{
		include(APPPATH.'third_party/dompdf/dompdf_config.inc.php');
		spl_autoload_register('DOMPDF_autoload');
		
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper("a4", 'portrait');
		$dompdf->render();
		if ($stream) {
			$dompdf->stream($filename.".pdf");
		} else {
			$CI =& get_instance();
			$CI->load->helper('file');
			$source_path ='downloads/'.$filename.'.pdf';
			if(write_file($source_path, $dompdf->output()))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

}
?>
