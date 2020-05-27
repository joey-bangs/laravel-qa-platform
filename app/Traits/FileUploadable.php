<?php


namespace App\Traits;


use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

trait FileUploadable
{
    /**
     * Handle and Manage file upload requests
     *
     * @param Request $request
     * @param string $directory
     *
     * @return false|string
     */
    private function handleUpload(Request $request, string $directory)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $directory_type = 'files';

            return $this->uploadFile($file, $directory_type, $directory);
        }

        return false;
    }

    /**
     * Upload file to target folder
     *
     * @param UploadedFile $file
     * @param string $directory_type
     * @param string $directory
     *
     * @return false|string
     */
    private function uploadFile(UploadedFile $file, string $directory_type, string $directory)
    {
        $file_name = time() . '_' . $directory . '.' . $file->clientExtension();

        return $file->storeAs("public/$directory_type/$directory", $file_name);
    }
}
