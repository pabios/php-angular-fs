<?php
require '../vendor/autoload.php';

$options = array(
    'cluster' => 'eu',
    'useTLS' => true
);
$pusher = new Pusher\Pusher(
    '2e4bc757da112b198aaf',
    'c4f181960b67c4f98291',
    '1473875',
    $options
);

$data['message'] = array(
    'age' => 22
);
//$data=json_encode('coucou');
$data = 'helo';
$pusher->trigger('pabiosoft', 'my-event', $data);