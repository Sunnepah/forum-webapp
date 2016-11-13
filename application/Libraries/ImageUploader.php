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
        $s3Client = new S3Client([
            'version'     => 'latest',
            'region'      => 'eu-central-1',
            'credentials' => [
                'key'    => ServiceConfig::$services['s3']['AccessKey_ID'],
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
}