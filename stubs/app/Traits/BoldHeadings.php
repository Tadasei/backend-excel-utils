<?php

namespace App\Traits;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

trait BoldHeadings
{
	private function addBoldHeadingsStyle(Worksheet $sheet): void
	{
		$sheet
			->getStyle("A1:{$sheet->getHighestColumn()}1")
			->getFont()
			->setBold(true);
	}
}
