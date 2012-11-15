<?php
//prevent from timing out
ini_set('memory_limit', '-1');
set_time_limit(0);

$me = './zipit.php';
$archive = tempnam(sys_get_temp_dir(), rand()); //write to tmp.  Most systems will have issues above 500M
$zip_file = $archive . '.zip'; // Add the .zip to tmpfile name
$base_path = $_SERVER['DOCUMENT_ROOT']; //base directory of the app.  

//zip function
function Zip($source, $destination)
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        echo "Zip extension is not present.  Please install the extention before runing this tool again.";
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

            $file = realpath($file);

            if (is_file($file) === true)
            {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
            else if (is_dir($file) === true)
            {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
}

Zip($base_path, $zip_file);

// do not touch below
if (file_exists($zip_file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($zip_file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($zip_file));
    flush();
    readfile($zip_file);
    unlink($zip_file); // Will only work IF the file is writable by the process!!!!!!!
    unlink($me);
    exit;
}

