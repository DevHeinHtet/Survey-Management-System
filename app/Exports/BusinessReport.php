<?php

namespace App\Exports;

use App\Models\Survey;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;

class BusinessReport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }
}
