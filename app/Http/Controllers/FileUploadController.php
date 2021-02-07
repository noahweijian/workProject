<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadPostRequest;
use App\Imports\ResultsImport;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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

        $date = new DateTime(now());
        $timezone = new DateTimeZone('Asia/Kuala_Lumpur');

        $local = $date->setTimezone($timezone);

        $country = $results[0]['country'];
        $week = $local->format('W');

        // // dd($week);
        // dd($results);

        return view('result')->with('results', $results)->with('week', $week + 2)->with('country', $country);

    }
}
