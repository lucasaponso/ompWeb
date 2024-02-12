<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

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
        echo "<script>console.log('Failed to open file:' );</script>";
        return [];
    }    
}

function appendToCsv($lines)
{
    foreach ($lines as $line)
    {
        $parts = explode(' ', $line);
        $csvFilename = $parts[1] . ".csv";
        $handle = fopen($csvFilename, 'w'); // Open the file for writing (truncate to zero length)
        if ($handle) 
        {
            fclose($handle); // Close the file handle
            echo "<script>console.log('Emptied File Successfully:' );</script>";
        } 
        else 
        {
            echo "<script>console.log('Emptied File UnSuccessfully:' );</script>";
        }
    }

    foreach ($lines as $line) 
    {
        $parts = explode(' ', $line);
        $csvFilename = trim($parts[1]) . ".csv"; // Trim to remove any leading/trailing whitespace
        $data = trim($parts[2]) . "," . trim($parts[3]) . "\n"; // Trim to remove any leading/trailing whitespace
        
        $handle = fopen($csvFilename, 'a'); // Open the CSV file for appending
        if ($handle) 
        {
            fwrite($handle, $data); // Write the data to the CSV file
            fclose($handle);
        } 
        else 
        {
            echo "<script>console.log('Failed to open for writing:' );</script>";
        }
    }
}

$filename = 'raw.data';
$lines = filterData($filename);
appendToCsv($lines);

?>

<?php

$filename = 'system.csv';
$data = file_get_contents($filename);

// Split the data into lines
$lines = explode("\n", $data);

// Assuming $lines contains your data as an array of strings, where each string is a CSV line
echo "<table class='styled-table'>";
foreach ($lines as $line) {
    // Split each line into key and value
    $fields = explode(",", $line);
    // Display each field as a table row with appropriate class
    echo "<tr>";
    foreach ($fields as $field) {
        echo "<td>$field</td>";
    }
    echo "</tr>";
}
// End the table
echo "</table>";



?>
<style>
    .styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}


.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}

</style>
