<?php

namespace App\Exports;

use App\Models\Participant;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Http\Request;

class StudentFontysEmailExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings
{
    /**
    * @return Collection
    */
    public function collection()
    {
        $userArr = [];
        $participants = Participant::all();
        foreach($participants as $participant)
        {
            if($participant->hasPaid() || $participant->purpleOnly){
                $userArr[] = $participant;
            }
        }
        return collect($userArr)->unique('fontysEmail');
    }

    public function headings(): array
    {
        return [
            'fontysEmail',
        ];
    }

    // here you select the row that you want in the file
    public function map($row): array {
        $fields = [
            $row->fontysEmail,
        ];
        return $fields;
    }
}
