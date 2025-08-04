<?php

namespace App\Enums;

use App\Exports\UserExport;

enum ExportType: string
{
	case UserExport = UserExport::class;
}
