<?php

namespace WebsiteBundle\Helper;

use WebsiteBundle\Entity\Document;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FileHelper
{
    /**
     * @param string $mediaDir
     */
    public function __construct($mediaDir)
    {
        $this->mediaDir = $mediaDir;
    }

    /**
     * @param Document $file
     *
     * @return BinaryFileResponse
     */
    public function download(Document $file)
    {
        $filePath = $file->getAbsolutePath();
        $fileName = $file->getOriginalName();

        if (!file_exists($filePath)) {
            throw new NotFoundHttpException('File Not Found');
        }

        $response = new BinaryFileResponse($filePath);
        $response->trustXSendfileTypeHeader();

        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $fileName
        );

        return $response;
    }

    /**
     * @param $absoluteFilePath
     */
    public function downloadFile($absoluteFilePath)
    {
        $finfo    = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $absoluteFilePath);
        finfo_close($finfo);
        $fileName = basename($absoluteFilePath);

        header('Content-Type', $mimeType);
        header('Content-disposition: attachment; filename="'.$fileName.'"');
        readfile($absoluteFilePath);
        exit;
    }

    public function encodeImageInBase64($absoluteFilePath)
    {
        $type   = pathinfo($absoluteFilePath, PATHINFO_EXTENSION);
        $data   = file_get_contents($absoluteFilePath, FILE_USE_INCLUDE_PATH);
        $base64 = 'data:image/'.$type.';base64,'.base64_encode($data);

        return $base64;
    }

    public function getRandomBackground()
    {
//        $folder = '';
//        $event  = $this->getBackgroundFolderEvent();
//
//        if ($event) {
//            $folder .= '/event/'.$event;
//        } else {
//        $folder .= '/regular';
//        }

        $folder = '/regular';

        try {
            $dirIterator  = new \RecursiveDirectoryIterator($this->mediaDir.$folder, \FilesystemIterator::SKIP_DOTS);
            $fileIterator = new \RecursiveIteratorIterator($dirIterator, \RecursiveIteratorIterator::LEAVES_ONLY);
            $files        = iterator_to_array($fileIterator, false);
            $index        = random_int(1, count($files) - 1);
            $filePath     = explode(dirname($this->mediaDir), $files[$index]->getPathName());

            return $filePath[1];
        } catch (\Exception $e) {
            return 'bundles/website/images/background.jpg';
        }
    }

    private function getBackgroundFolderEvent()
    {
        $event = null;
        $today = date('n').date('d');

        if ($today >= 101 && $today <= 131) {
            $event = 'new_year';
        } else if ($today >= 1025 && $today <= 1101) {
            $event = 'halloween';
        } else if ($today >= 1201 && $today <= 1231) {
            $event = 'christmas';
        }

        return $event;
    }

    public function getName()
    {
        return 'file';
    }
}
