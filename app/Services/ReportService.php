<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

class ReportService{

    public function __construct(
        private Collection $rows,
    ) {
        
    }
    public function generateReport(){
        
    }
}