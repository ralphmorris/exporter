<?php

use PHPUnit\Framework\TestCase;
use RalphMorris\Exporter\Exporter;

class CsvExportTest extends TestCase
{

	function test_go_to_url_and_get_csv_response()
	{
	    $response = str_getcsv( file_get_contents('http://local.packages-dev.vm/export') );

	    $this->assertTrue( !empty( $response[0] ) );
	    
	    $this->assertEquals( $response[0], 'id' );
	}

	function test_if_a_filename_is_passed_to_export_to_csv_method_use_that_instead() 
	{
		$exporter = new Exporter;

		$filename = 'my file.csv';

		$this->assertEquals($filename, $exporter->fileName($filename));
	}

}