<?php
namespace Validator\Lib;

class ImageValidator extends BinaryValidator
{
    public function __construct($rule, $attribute, $params)
    {
        parent::__construct($rule, $attribute, $params);
        $this->validate($rule, $attribute, $params);
    }

    public function validate($rule, $attribute, $params)
    {
        $supportedImageMimeTypes = [
            'image/png',
            'image/jpeg',
            'image/gif',
            'image/webp',
        ];

        $mimeType = $this->getMimeType($_FILES[$attribute]['tmp_name']);
        if (in_array($mimeType, $supportedImageMimeTypes)) {
            return true;
        }
        throw new \LogicException($attribute. ' Unsupported image type: ' . $mimeType );
    }
}
