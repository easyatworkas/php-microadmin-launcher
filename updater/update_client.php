<?php

const UPDATE_URL = 'https://github.com/easyatworkas/php-eaw-client/archive/refs/heads/master.zip';
const UPDATE_FILE = 'client.zip';
const NESTED_DIR = 'php-eaw-client-master';
const TARGET_DIR = '../client';

chdir(__DIR__);

$ch = curl_init(UPDATE_URL);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$content = curl_exec($ch);
$errno = curl_errno($ch);
curl_close($ch);

if ($errno || strlen($content) == 0) {
	throw new Exception("Download failed. Curl errno: " . $errno);
}

echo 'Downloaded ', round(strlen($content) / 1024), ' kB', PHP_EOL;

file_put_contents(UPDATE_FILE, $content);

$zip = new ZipArchive();
$zip->open(UPDATE_FILE, ZipArchive::RDONLY);
$zip->extractTo('.');
$zip->close();

unlink(UPDATE_FILE);

if (file_exists(TARGET_DIR)) {
	rrmdir(TARGET_DIR);
}

rename(NESTED_DIR, TARGET_DIR);

exit;

function rrmdir($src) {
	$dir = opendir($src);
	
	while (false !== $file = readdir($dir)) {
		if ($file != '.' && $file != '..') {
			$full = $src . '/' . $file;
			
			if (is_dir($full)) {
				rrmdir($full);
			} else {
				unlink($full);
			}
		}
	}
	
	closedir($dir);
	rmdir($src);
}
