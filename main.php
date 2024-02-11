<?php
// Open the file for reading
$filename = 'raw.data';
$handle = fopen($filename, 'r');

// Check if the file opened successfully
if ($handle) {
    // Read and print each line until the end of the file
    while (($line = fgets($handle)) !== false) {
        echo $line;
    }

    // Close the file handle
    fclose($handle);
} else {
    echo "Failed to open file.";
}
?>
