<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NotebookService
{
    protected $storage;

    public function __construct()
    {
        $this->storage = Storage::disk('public');
    }

    public function createNewImage($file)
    {
        if(is_null($file)){
            return;
        }

        $fileName = Str::random(32) . '.' . $file->getClientOriginalExtension();
        return $this->storage->putFile('images',$file);           
    }

    public function deleteOldImage($fileName)
    {
        if(is_null($fileName)){
            return;
        }

        $this->storage->delete($fileName);

    }
}