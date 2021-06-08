<?php

require 'Client.php';

$client = new Client();

/*$params = [
    "file_size" => filesize(__DIR__ . '/videos/teste1.mp4'),
    "file_md5" => md5(__DIR__ . '/videos/teste1.mp4')
];
$client->initVideoUpload($params);*/

/*$params = [
    'video_upload_id' => 'vn_4e5b661a-22ff-441b-8a99-4bf21e2a1cad_000000',
    'part_seq' => 0,
    'content_md5' => md5(__DIR__ . '/videos/test1-part1.mp4'),
    'part_content' => __DIR__ . '/videos/test1-part1.mp4'
];

$client->uploadVideoPart($params);*/

/*$params = [
    'video_upload_id' => 'vn_4e5b661a-22ff-441b-8a99-4bf21e2a1cad_000000',
    'part_seq_list' => [0, 1, 2],
    'report_data' => [
        "upload_cost" => 11832
    ]
];

$client->completeVideoUpload($params);*/


/*$params = [
    'video_upload_id' => 'vn_4e5b661a-22ff-441b-8a99-4bf21e2a1cad_000000',
];

$client->getVideoUploadResult($params);*/

$params = [
    'video_upload_id' => 'vn_4e5b661a-22ff-441b-8a99-4bf21e2a1cad_000000',
];

$client->cancelVideoUpload($params);

/*$params = [
    'image' => __DIR__ . '/images/teste1.png'
];
$client->uploadImage($params);*/



