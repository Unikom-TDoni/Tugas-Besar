<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

final class FileService 
{
    private $defaultFilePath;
    private $lastProcessedFile;

    public function __construct()
    {
        $this->defaultFilePath = 'images/profile/';
    }

    /**
     * Store file to public base
     * 
     * @param PrimaryKey @id
     * @param mixed|null @file
     */
    public function store($id, $file) 
    {
        if(is_null($file))
        {
            $this->lastProcessedFile = null;
            return;
        }

        $fileName = $id.".".$file->getClientOriginalExtension();

        if(File::exists($this->defaultFilePath.$fileName))
            File::delete($this->defaultFilePath.$fileName);
        
        $file->move($this->defaultFilePath, $fileName);

        $this->lastProcessedFile = $fileName;
    }

    /**
     * Get Last Processed File
     * 
     * @return mixed
     */
    public function getProcessedFileData()
    {
        return $this->lastProcessedFile;
    }
}