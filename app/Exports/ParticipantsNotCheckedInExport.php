<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;

class ParticipantsNotCheckedInExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Participant::all();
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
