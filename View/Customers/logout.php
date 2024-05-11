<?php
session_start();
session_destroy();

// Clear cache-related headers
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

// Redirect to the desired location
header("Location: ../../index.php");
exit;
?>
