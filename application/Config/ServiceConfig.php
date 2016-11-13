<?php
/**
 * Created by: Sunday Ayandokun
 * Email: sunday.ayandokun@gmail.com
 * Date: 13/11/2016
 * Time: 3:17 PM
 */

namespace application\Config;

class ServiceConfig
{
    /*
   |-----------------------------------------------------
   | Service configuration
   |-----------------------------------------------------
   | Configuration for database drivers
   */

    static $services = [
        's3' => [
            'S3_BUCKET'         => 'bucket_name',
            'AccessKey_ID'      => 'somestring',
            'SecretAccess_Key'  => 'somestring'
        ]
    ];
}