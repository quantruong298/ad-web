<?php


namespace App\Helpers;


class GoogleDrive
{

    /**
     * Upload file to GoogleDrive.
     *
     * @param $request ->file
     * @return array $file_name, $link_file
     */
    public static function uploadFileToGoogleDrive($file)
    {
        $name = $file->getClientOriginalName();
        $arrayName = explode('.', $name);
        $filename = $arrayName[0] . '-' . time() . '.' . $arrayName[1];

        $pathPublic = public_path() . '/files/';
        if (\File::exists($pathPublic . $filename)) {
            unlink($pathPublic . $filename);
        }
        if (!\File::exists($pathPublic)) {
            \File::makeDirectory($pathPublic, $mode = 0777, true, true);
        }
        $file->move($pathPublic, $filename);
        $fileData = \File::get($pathPublic . $filename);
        \Storage::cloud()->put($filename, $fileData);

        unlink($pathPublic . $filename);

        $dir = '/';
        $recursive = false;
        $contents = collect(\Storage::cloud()->listContents($dir, $recursive));
        $link_file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            ->first();

        $link_file = 'https://drive.google.com/uc?id=' . $link_file['path'];
        $file_name = $filename;

        return array([
            'link_file' => $link_file,
            'file_name' => $file_name
        ]);
    }

    /**
     * Delete file from GoogleDrive.
     *
     * @param $file_name
     * @return
     */
    public static function deleteFileFromGoogleDrive($file_name)
    {
        $dir = '/';
        $recursive = false;
        $contents = collect(\Storage::cloud()->listContents($dir, $recursive));
        $link_img = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($file_name, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($file_name, PATHINFO_EXTENSION))
            ->first();
        \Storage::cloud()->delete($link_img['path']);
    }


}