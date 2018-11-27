<?php
$access_token = '3dpztB8bJVB0oLtKLyOQuuKAz+0kwImsk7qzUdI1d3cyp81lis9JeaqN/pMzQD9jIkULSUOFFJy8kbdBil3LJLeHMzsBMjhWqZe9MqLtOmiVW6Q5nLKsqnM5C2RjA+4Uw46Ojcm8crZFHd5Eb3/sIAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;