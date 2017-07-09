<?php
include_once 'core.php';
include_once 'library.php';
include_once 'models.php';

/**
 * Worker for email service
 *   sebagai contoh untuk membuat service
 */
$action = function ($data) {
    $arrdata = (Object) json_decode($data);
    $email = new Email;
    foreach ($arrdata->to[0] as $to) {
        if ($to == '') {
            continue;
        }
        $email->to($to);
    }
    $email->subject($arrdata->subject);
    $email->body(base64_decode($arrdata->body));
    $email->execute();
};
$emailworker = new ServiceWorker('email');
$emailworker->addAction($action);

/**
 * Add all workers
 */
$workers[] = $emailworker;