<?php

use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->usePutenv();
$dotenv->loadEnv(__DIR__.'/../.env', null, 'dev', ['test'], true);

putenv('T3DD25_7=php (code)');
putenv('T3DD25_PHP=php (code)');
$env_vars = [];
foreach ($_ENV as $key => $value) {
    if (str_starts_with($key, 'T3DD25')) {
        $env_vars[$key] = $value;
    }
}
ksort($env_vars);

$getenv_vars = [];
foreach (getenv() as $key => $value) {
    if (str_starts_with($key, 'T3DD25')) {
        $getenv_vars[$key] = $value;
    }
}
ksort($getenv_vars);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T3DD25: DDEV Level Up</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>T3DD25 Level Up</h1>

<h2>Environment Variables (from getenv())</h2>
<?php
if (!empty($getenv_vars)): ?>
    <table>
        <thead>
        <tr>
            <th>Variable Name</th>
            <th>Value</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($getenv_vars as $key => $value): ?>
            <tr>
                <td><?php
                    echo htmlspecialchars($key); ?></td>
                <td><?php
                    echo htmlspecialchars($value); ?></td>
            </tr>
        <?php
        endforeach; ?>
        </tbody>
    </table>
<?php
else: ?>
    <p>No environment variables starting with 'T3DD25' found in getenv().</p>
<?php
endif; ?>

<h2>Environment Variables (from $_ENV)</h2>
<?php
if (!empty($env_vars)): ?>
    <table>
        <thead>
        <tr>
            <th>Variable Name</th>
            <th>Value</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($env_vars as $key => $value): ?>
            <tr>
                <td><?php
                    echo htmlspecialchars($key); ?></td>
                <td><?php
                    echo htmlspecialchars($value); ?></td>
            </tr>
        <?php
        endforeach; ?>
        </tbody>
    </table>
<?php
else: ?>
    <p>No environment variables starting with 'T3DD25' found in $_ENV.</p>
    <p>If $_ENV is empty, it might be because variables_order in php.ini does not include E.</p>
    <pre>
; php.ini
variables_order = "EGPCS"  ; Ensure E is included for $_ENV
    </pre>

<?php
endif; ?>


</body>
