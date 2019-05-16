<?php
namespace Validator\Lib;

class BinaryValidator
{
    public function __construct($rule, $attribute, $params)
    {
        $this->maxsize = isset($rule['maxsize']) ? $rule['maxsize'] : PHP_INT_MAX;

        if (!isset($_FILES[$attribute]) || $_FILES[$attribute]['error'] != UPLOAD_ERR_OK) {
            throw new \LogicException('File upload error '. $attribute .' Binary');
        }

        $binaryFile = $_FILES[$attribute];
        if (!empty($binaryFile['size']) && $binaryFile['size'] <= (int) $this->maxsize) {
            return true;
        }

        throw new \LogicException('File size is too large', $attribute, 'Binary');
    }


    public  function getMimeType($filename)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        if (!$finfo) {
            return false;
        }
        if (!file_exists($filename)) {
            return false;
        }
        $mimeType = finfo_file($finfo, $filename);
        finfo_close($finfo);

        return $mimeType;
    }
}
