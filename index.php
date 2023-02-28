<?php

// Start the session
session_start();

// Set a session variable
$_SESSION['username'] = 'john.doe';

// Set a cookie to remember the session ID
setcookie(session_name(), session_id(), time() + 3600, '/');

?>

<html>
  <head>
    <title>My Page</title>
  </head>
  <body>
    <h1>Welcome <?php echo $_SESSION['username']; echo "\n"; echo session_id(); ?>!</h1>
    <p>This is your personal page.</p>
  </body>
</html>
