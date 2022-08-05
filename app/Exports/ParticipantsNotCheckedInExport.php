<?php

namespace App\Exports;

use App\Models\Participant;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromCollection;

class ParticipantsNotCheckedInExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $userArr = [];
        $participants = Participant::all();
        foreach($participants as $participant)
        {
            if($participant->hasPaid() || $participant->purpleOnly) {
                $userArr[] = $participant;
            }
        }
        return collect($userArr)->unique('fontysEmail');    }

    public function headings(): array
    {
        return [
            'id',
            'firstName',
            'lastName',
            'email',
            'fontysEmail',
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
            $row->email,
            $row->fontysEmail,
            $row->specials,
            $row->medicalIssues,
        ];
        return $fields;
    }
}
