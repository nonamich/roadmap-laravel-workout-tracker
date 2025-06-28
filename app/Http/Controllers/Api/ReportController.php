<?php

namespace App\Http\Controllers\Api;

use App\Data\Api\Reports\ReportRequestData;
use App\Http\Controllers\BaseController;
use App\Services\ReportService;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;

#[Authenticated]
#[Group('Report')]
class ReportController extends BaseController
{
    public function __construct(private ReportService $reportService) {}

    public function show(ReportRequestData $data): JsonResponse
    {
        $s = $this->reportService->generate($this->getUserOrThrow(), $data);

        return response()->json($s);
    }
}
