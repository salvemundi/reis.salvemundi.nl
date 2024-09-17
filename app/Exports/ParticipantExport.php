<?php

namespace App\Exports;

use App\Enums\DocumentTypes;
use App\Models\Participant;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParticipantExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        return Participant::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'firstName',
            'insertion',
            'lastName',
            'email',
            'documentType',
            'documentNumber',
            'birthday',
        ];
    }

    public function map($row): array {
        $fields = [
            $row->id,
            $row->firstName,
            $row->insertion,
            $row->lastName,
            $row->email,
            DocumentTypes::getDescription($row->documentType ?? 0),
            $row->documentNumber,
            $row->birthday,
        ];
        return $fields;
    }
}
