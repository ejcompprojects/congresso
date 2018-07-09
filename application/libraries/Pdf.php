<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pdf {


	function __construct()

	{

		$CI = & get_instance();

		log_message('Debug', 'mPDF class is loaded.');

	}


	function load($param=NULL)

	{

		include_once APPPATH.'third_party/mpdf/mpdf.php';


		if ($param == NULL)

		{

			$param = '"en-GB-x","A4-L","","",10,10,10,10,6,3,"F"';

		}


		return new mPDF( '',    // mode - default ''
						 'A4-L',    // format - A4, for example, default ''
						 0,    // font size - default 0
						 'agency_fb',    // default font family
						 15,    // margin_left
						 15,    // margin right
						 16,     // margin top
						 16,    // margin bottom
						 9,     // margin header
						 9,     // margin footer
						 'P');

	}

}
