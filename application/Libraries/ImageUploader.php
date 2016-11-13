<?php
/**
 * Created by: Sunday Ayandokun
 * Email: sunday.ayandokun@gmail.com
 * Date: 13/11/2016
 * Time: 3:12 PM
 */

namespace Application\Libraries;

use Aws\S3\S3Client;
use Application\Config\ServiceConfig;

class ImageUploader
{
    public static function upload_image($image_data) {
        if (!self::isImageSupported($image_data))
            return false;

        $s3Client = new S3Client([
            'version' => 'latest',
            'region' => 'eu-central-1',
            'credentials' => [
                'key' => ServiceConfig::$services['s3']['AccessKey_ID'],
                'secret' => ServiceConfig::$services['s3']['SecretAccess_Key'],
            ],
        ]);

        $bucket = ServiceConfig::$services['s3']['S3_BUCKET'] ?: die('No "S3_BUCKET" config var in found!');

        if (isset($image_data['userfile']) && is_uploaded_file($image_data['userfile']['tmp_name'])) {
            try {
                $upload = $s3Client->upload($bucket, $image_data['userfile']['name'],
                    fopen($image_data['userfile']['tmp_name'], 'rb'), 'public-read');

                return $upload->get('ObjectURL');
            } catch (\Exception $e) {
                throw new \Exception($e);
            }
        }

        return false;
    }

    public static function isImageSupported($image_data) {
        /** TODO: Move to App config file */
        $maxFileSize = 2097152;
        $maxWidth = 1920;
        $maxHeight = 1080;

        $path_info = pathinfo($image_data["userfile"]["name"]);
        if (!self::isValidType($path_info['extension']))
            return false;

        if ($image_data['userfile']['size'] > $maxFileSize)
            return false;

        $image_dimensions = getimagesize($image_data['userfile']['tmp_name']);
        $image_width = $image_dimensions[0];
        $image_height = $image_dimensions[1];
        if (($image_width > $maxWidth) || ($image_height > $maxHeight))
            return false;

        return true;
    }

    private static function isValidType($image_type) {
       return in_array($image_type, ['jpg', 'jpeg', 'png', 'gif']);
    }
}