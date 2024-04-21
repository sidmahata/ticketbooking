<?php

namespace App\Services;

use App\Contracts\Report;
use Illuminate\Contracts\Database\Eloquent\Builder;
use ExcelReport;
use PdfReport;
use CSVReport;

class ReportGenerator implements Report{
    public function __construct()
    {
        
    }

    public function download(Builder $queryBuilder, String $title='Report', array $meta=[], array $columns=[], String $fileName='Report', String $type='pdf')
    {
        return ($this->getReportClassName($type))::of($title, $meta, $queryBuilder, $columns)->download($fileName);
    }
    private function getReportClassName($type){
        switch ($type) {
            case 'pdf':
                return 'PdfReport';
                break;
            case 'excel':
                return 'ExcelReport';
                break;
            case 'csv':
                return 'CSVReport';
                break;
            default:
                return 'PdfReport';
                break;
        }
    }
}