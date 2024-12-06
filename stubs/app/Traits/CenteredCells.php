<?php

namespace App\Traits;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

trait CenteredCells
{
	private function addCenteredCellsStyle(Worksheet $sheet): void
	{
		$sheet
			->getStyle(
				"A1:{$sheet->getHighestColumn()}{$sheet->getHighestRow()}",
			)
			->getAlignment()
			->setHorizontal(Alignment::HORIZONTAL_CENTER)
			->setVertical(Alignment::VERTICAL_CENTER);
	}
}
