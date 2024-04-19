<?php
$url = $_GET['url'];
$format = $_GET['format'];

// Use youtube-dl to download the video
exec("youtube-dl -o 'temp.%(ext)s' --format 'bestvideo[ext=mp4]+bestaudio[ext=m4a]/bestvideo+bestaudio' $url");

// Use ffmpeg to convert the downloaded video to the desired format
exec("ffmpeg -i temp.mp4 -c:a copy -c:v copy output.$format");

// Provide the converted file for download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="output.'.$format.'"');
readfile('output.'.$format);

// Clean up temporary files
unlink('temp.mp4');
unlink('output.'.$format);
?>
