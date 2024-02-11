<?php

function filterData($filename)
{
    $handle = fopen($filename, 'r');
    if ($handle) 
    {
        $lines = [];
        while (($line = fgets($handle)) !== false) 
        {
            $line = str_replace('config', '', $line);    
            if (strpos($line, ';') === false && strpos($line, '[') === false) 
            {
                $lines[] = $line;
            }
        }
        fclose($handle);
        return $lines;
    } 
    else 
    {
        echo "Failed to open file.";
        return [];
    }    
}

function appendToCsv($lines)
{
    foreach ($lines as $line) 
    {
        $parts = explode(' ', $line);
        $csvFilename = trim($parts[1]) . ".csv"; // Trim to remove any leading/trailing whitespace
        $data = trim($parts[2]) . "," . trim($parts[3]) . "\n"; // Trim to remove any leading/trailing whitespace
        
        echo "CSV Filename: " . $csvFilename . "\n";
        echo "Data: " . $data;
        
        $handle = fopen($csvFilename, 'a'); // Open the CSV file for appending
        if ($handle) 
        {
            fwrite($handle, $data); // Write the data to the CSV file
            fclose($handle);
        } 
        else 
        {
            echo "Failed to open file for writing.";
        }
    }
}

$filename = 'raw.data';
$lines = filterData($filename);
appendToCsv($lines);

?>
