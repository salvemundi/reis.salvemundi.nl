<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ParticipantExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
    public function exportAllToExcel(): BinaryFileResponse
    {
        return Excel::download(new ParticipantExport, 'allParticipants.xlsx');
    }
}
