<?php
include('db.php');  //your db connection

$all = "select * from pages";
$results = mysqli_query($db, $all);
while ($roww = mysqli_fetch_assoc($results)) {
    $all_pages[] = $roww;
}

$xml_file = "sitemap.xml";
unlink($xml_file); //deletes previously generated sitemap 

$fp = fopen($xml_file, 'a'); //opens file in append mode  
$tag = '<?xml version="1.0" encoding="UTF-8"?>';
$schemas = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

fwrite($fp, $tag);
fwrite($fp, $schemas);

$baseURL = "http://localhost/";

foreach ($all_pages as $link) {

    $link =  $baseURL.$link['path']; //adjest according to your needs
    
    $urlset = '<url><loc>' . $link . '</loc><changefreq>monthly</changefreq><priority>0.9</priority></url>';
    fwrite($fp, $urlset);
}

$endtag = '</urlset>';
fwrite($fp, $endtag);


fclose($fp);
