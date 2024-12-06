<?php

namespace App\Traits;

use PhpOffice\PhpSpreadsheet\Cell\{
	Cell,
	DataType
};

trait CustomCellDataTypes
{
	private function getCustomCellDataType(
		Cell $cell,
		$value,
		array $selectedDataTypes = [],
	): string|null {
		return optional(
			collect([
				[
					"name" => "phoneNumber",
					"cellDataType" => DataType::TYPE_STRING,
					"applies" =>
						is_string($value) && str_starts_with($value, "+"),
				],
			])
				->filter(
					fn(array $value) => $selectedDataTypes
						? in_array($value["name"], $selectedDataTypes)
						: true,
				)
				->firstWhere("applies"),
		)["cellDataType"];
	}
}
