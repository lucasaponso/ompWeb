<?php
$filename = 'raw.data';
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
} 
else 
{
    echo "Failed to open file.";
}

foreach ($lines as $line) 
{
    echo $line . "\n";
}
?>
