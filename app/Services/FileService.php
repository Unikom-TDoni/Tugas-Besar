<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

final class FileService 
{
    private $lastFileData;
    private $defaultFilePath;

    public function __construct()
    {
        $this->defaultFilePath = 'images/profile/';
    }

    public function store($id, $file) 
    {
        if(is_null($file))
        {
            $this->lastFileData = null;
            return;
        }

        $fileName = $id.".".$file->getClientOriginalExtension();

        if(File::exists($this->defaultFilePath.$fileName))
            File::delete($this->defaultFilePath.$fileName);
        
        $file->move($this->defaultFilePath, $fileName);

        $this->lastFileData = $this->defaultFilePath.$fileName;
    }

    public function getProcessedFileData()
    {
        return $this->lastFileData;
    }
}