<?php

namespace App\Http\Controllers;

use App\Models\FansLike;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class FansController extends Controller
{
    public function all()
    {
        $output = request('output', 'json');
        $format = request('format', 'multipage');
        $pageName = request('page_name', 'all');

        $offset = (int) request('offset', 1);
        $limit = (int) request('limit');

        $filters = [
            'output' => [
                'description'       => 'Output type',
                'default'           => 'json',
                'available_values'  => [
                    'json',
                    'csv'
                ]
            ],

            'format' => [
                'description'       => 'Output data structure (available for [json] output only)',
                'default'           => 'multipage',
                'available_values'  => [
                    'table',
                    'linechart',
                    'multipage'
                ]
            ],

            'page_name' => [
                'description'       => 'Facebook company page name (page ID)',
                'default'           => 'all',
                'available_values'  => [
                    'all',
                    'cocacola',
                    'apple',
                    'intel'
                ]
            ],

            'limit' => [
                'description'       => 'Number of results per page',
                'default'           => 0, // all results
            ],

            'offset' => [
                'description'       => 'Results offset (works if [limit] parameter is passed',
                'default'           => 0,
            ],
        ];

        if ($output === 'csv') {
            $results = FansLike::all();
        } else {
            $results = FansLike::getChunked($offset, $limit, $pageName);
        }

        switch ($output) {
            case 'csv':
                (App::make('excel'))->create('FansLikes ' . Carbon::now()->toDateTimeString(), function ($excel) use ($results){
                    $excel->sheet('Sheet 1', function ($sheet) use ($results) {
                        $sheet->fromArray($results);
                    });
                })->export('xlsx');
            case 'json':
            default:
                $results = FansLike::getTransformedItems($results, $format);
                $response = [
                    'error'     => !(bool) $results,
                    'filters'   => $filters,
                    'data'      => $results
                ];
                return response()->json($response);
        }
    }
}
