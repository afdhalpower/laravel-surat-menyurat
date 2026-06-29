<?php

namespace App\Exports;

use App\Models\Letter;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OutgoingLetterExport implements FromCollection, WithHeadings, WithMapping
{
    protected $since;
    protected $until;
    protected $filter;

    public function __construct($since = null, $until = null, $filter = null)
    {
        $this->since = $since;
        $this->until = $until;
        $this->filter = $filter;
    }

    public function collection(): Collection
    {
        return Letter::outgoing()
            ->agenda($this->since, $this->until, $this->filter)
            ->get();
    }

    public function headings(): array
    {
        return [
            __('model.letter.agenda_number'),
            __('model.letter.reference_number'),
            __('model.letter.to'),
            __('model.letter.letter_date'),
            __('model.letter.received_date'),
            __('model.letter.description'),
            __('model.letter.note'),
        ];
    }

    public function map($letter): array
    {
        return [
            $letter->agenda_number,
            $letter->reference_number,
            $letter->to,
            $letter->formatted_letter_date,
            $letter->received_date ?? '-',
            $letter->description,
            $letter->note,
        ];
    }
}
