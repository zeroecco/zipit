zipit
=====

Tool for recursively zipping and downloading your php app.

## How it Works

Zipit will download your php based app to your local system using the Zip extension commonly found in php environments. Here is its' process:

1. The zipit script will recursively add all files from the DOCUMENT ROOT.

1. Once all files have been zipped to a temp directory, The if statement initiates the download of the zipball.

1. Once the zipball is downloaded, the zipball is removed, as is the zipit.php file.


## Known Issues

1. If the zipit.php file is not writable by the process the file WILL NOT GET REMOVED!

1. Downloads in excess of 500M have been seen to have issues due to timeouts.


