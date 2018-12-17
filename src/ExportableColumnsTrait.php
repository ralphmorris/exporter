<?php

namespace RalphMorris\Exporter;

trait ExportableColumnsTrait
{
    public function scopeExportableColumns($query) 
    {
        return $query->select( $this->exportableColumns );
    }
}