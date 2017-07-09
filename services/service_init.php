<?php
include_once 'core.php';
include_once 'library.php';
include_once 'models.php';
include_once 'workers.php';

$service = new Service;
foreach ($workers as $worker) {
    $service->addWorker($worker);
}

for (;;) {
    $service->start();
    sleep(1);
}