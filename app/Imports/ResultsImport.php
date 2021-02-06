<?php

namespace App\Imports;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ResultsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collections)
    {
        dd($collections);
        Validator::make($collections->toArray(), [
            '*.country' => 'exists'
        ])->validate();
    }

}
