<?php
namespace Validator\Lib;

class AudioValidator extends BinaryValidator
{
    public function __construct($rule, $attribute, $params)
    {
        parent::__construct($rule, $attribute, $params);
        $this->validate($rule, $attribute, $params);
    }

    public function validate($rule, $attribute, $params)
    {
        $supportedAudioMimeTypes = [
            'audio/mp4',
            'video/mp4',
            'video/3gpp',
            'audio/x-hx-aac-adts',
            'audio/aac',
        ];
        $mimeType = $this->getMimeType($_FILES[$attribute]['tmp_name']);
        if (in_array($mimeType, $supportedAudioMimeTypes)) {
            return true;
        }
        throw new \LogicException($attribute. ' Unsupported audio type: ' . $mimeType );
    }
}
