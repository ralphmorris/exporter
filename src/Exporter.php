<?php

namespace RalphMorris\Exporter;

use Carbon\Carbon;
use Response;

class Exporter
{
	/**
	 * Export any collection of models to CSV. All fields exported.
	 * 
	 * @param  Collection $collection
	 * @param  Optional filename $collection
	 * @return \Response downloads CSV
	 */
	public function exportToCsv($collection, $fileName = null)
	{
		$f = fopen('php://memory', 'w+');
		
		$header = array_keys($collection->first()->toArray());

		fputcsv($f, $header);

		foreach ($collection as $thread)
		{
		    fputcsv($f, $thread->toArray());
		}

		rewind($f);

		return Response::make(stream_get_contents($f), 200, $this->headers($fileName));
	}

	/**
	 * Optionaly creates a filename with Carbon
	 * 
	 * @param  string $fileName
	 * @return string 
	 */
	public function fileName($fileName = null)
	{
		if (is_null( $fileName )) 
		{
			return Carbon::now() . '.csv';
		}

		return $fileName;
	}

	/**
	 * Set up the headers for the CSV output
	 * 
	 * @param  string $fileName
	 * @return array
	 */
	public function headers($fileName = null)
	{
		return [
		    'Content-Type' => 'text/csv',
		    'Content-Disposition' => 'attachment; filename="'.$this->fileName($fileName).'"',
		];
	}
}