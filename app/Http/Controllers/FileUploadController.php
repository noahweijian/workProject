<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadPostRequest;
use App\Imports\ResultsImport;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class FileUploadController extends Controller
{
    public function fileUpload()
    {
        return view('result');
    }

    /**
     *
     */
    public function fileUploadPost(FileUploadPostRequest $request)
    {
        $data = Excel::toArray(new ResultsImport, $request->file);

        $results = Arr::collapse($data);

        Validator::make($results, [
            '*.country' => 'required',
            '*.segment' => 'required',
            // '*.relative_path' => 'required',
            // '*.naming_convention' => 'required'
        ])->validate();

        // dd($results);
        $country = $results[0]['country'];
        $week = $results[0]['cw_start_date'];

        // dd($results);

        return view('result')->with('results', $results)->with('week', $week)->with('country', $country);

    }
}
