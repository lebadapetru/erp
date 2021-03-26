<?php


namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\File as HttpFoundationFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileDecoder
{
    private mixed $data;

    private string $fileName;

    public function __construct(
        private ParameterBagInterface $parameterBag
    ) {}

    public function init(mixed $data, string $fileName = '')
    {
        $this->data = $data;
        $this->fileName = $fileName;

        try {
            if ($this->isUploadedFile()) {
                return $this->data;
            } elseif ($this->isUrl()) {
                return $this->initFromUrl();
            }
        } catch (\Exception $e) {
            //throw init exception
        }
    }

    private function isUrl(): bool
    {
        return Helpers::isUrl($this->data);
    }

    private function isUploadedFile(): bool
    {
        if ($this->data instanceof HttpFoundationFile && file_exists($this->data->getPathname())) {
            return true;
        }

        return false;
    }

    private function initFromUrl(): UploadedFile
    {
        //$tmpFile = tmpfile();
        //$path = stream_get_meta_data($tmpFile)['uri']; // eg: /tmp/phpFx0513a
//        $remoteFile = fopen($this->data, 'r');
//        stream_copy_to_stream($remoteFile, $tmpFile);
//
//        if (is_resource($remoteFile)) {
//            fclose($remoteFile);
//        }
        $content = file_get_contents($this->data);
        $path = $this->parameterBag->get('kernel.project_dir') . '/public/'. $this->parameterBag->get('app.upload_dir') . '/test.jpg';
        file_put_contents(
            $path,
            $content
        );


        return new UploadedFile($path, $this->fileName);
    }
}