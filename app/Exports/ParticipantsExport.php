<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Http\Request;

class ParticipantsExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Participant::where('checkedIn', 1)->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'firstName',
            'lastName',
            'specials',
            'medicalIssues',
        ];
    }

    // here you select the row that you want in the file
    public function map($row): array {
        $fields = [
            $row->id,
            $row->firstName,
            $row->lastName,
            $row->specials,
            $row->medicalIssues,
        ];
        return $fields;
    }
}
