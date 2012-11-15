zipit
=====

Tool for recursively zipping and downloading your php app.

## How it Works

Zipit will download your php based app to your local system using the Zip extension commonly found in php environments. Here is its' process:

1. The zipit script will recursively add all files from the DOCUMENT ROOT.

1. Once all files have been zipped to a temp directory, The if statement initiates the download of the zipball.

1. Once the zipball is downloaded, the zipball is removed, as is the zipit.php file.


note:  While the page is loading, the script is actually zipping your app up for you, for larger apps this can take up to 2 minutes to complete (depending on your server).
## Known Issues

1. If the zipit.php file is not writable by the process the file WILL NOT GET REMOVED!

1. Downloads in excess of 500M have been seen to have issues due to timeouts and/or space limitations.

## Acknowledgement

The recursive zip function itself came from this stackoverflow article: http://stackoverflow.com/questions/1334613/how-to-recursively-zip-a-directory-in-php


