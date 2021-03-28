<?php


namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileDecoder
{
    private mixed $data;

    private string $fileName;

    public function __construct(
        private ParameterBagInterface $parameterBag,
        private SluggerInterface $slugger
    ) {}

    public function init(mixed $data, string $fileName = '')
    {
        if ($data instanceof UploadedFile) {
            return $data;
        }
        $this->data = $data;
        $this->fileName = $fileName;

        if ($this->isUrl()) {
            return $this->initFromUrl();
        } else {
            throw new UploadException('File not supported.');
        }
    }

    private function isUrl(): bool
    {
        return Helpers::isUrl($this->data);
    }

    private function initFromUrl(): UploadedFile
    {
        /*$tmpFile = tmpfile();
        $path = stream_get_meta_data($tmpFile)['uri']; // eg: /tmp/phpFx0513a
        $remoteFile = fopen($this->data, 'r');
        stream_copy_to_stream($remoteFile, $tmpFile);

        if (is_resource($remoteFile)) {
            fclose($remoteFile);
        }*/

        $fileName = !empty($this->fileName) ? $this->fileName : $this->data;

        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileName = pathinfo($fileName, PATHINFO_FILENAME);
        $fileFullName = $this->slugger->slug($fileExtension) . '.' . $this->slugger->slug($fileExtension);

        //check after sanitize if it's empty
        if (empty($fileName) || empty($fileExtension)) {
            throw new BadRequestHttpException('The file name is invalid.');
        }
        /*TODO see which is better stream vs file_get_contents in terms of performance,security&reliability*/
        $content = file_get_contents($this->data);
        /*TODO make this dynamic, to work with s3 storage*/
        $path = $this->parameterBag->get('kernel.project_dir') . '/public/' . $this->parameterBag->get('app.upload_dir') . '/' . $fileFullName;
        file_put_contents(
            $path,
            $content
        );

        return new UploadedFile($path, $fileFullName);
    }
}