<?php
$file = 'c:/xampp/htdocs/wintech-new/resources/views/site/job/index.blade.php';
$content = file_get_contents($file);
if(preg_match('/(?s)<style>.*?<\/style>/', $content, $matches)) {
    $style = $matches[0];
    $content = str_replace($style, '', $content);
    $content = str_replace("@section('content')", "@section('content')\n" . $style, $content);
    file_put_contents($file, $content);
    echo "Fixed";
} else {
    echo "Style not found";
}
