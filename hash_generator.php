<?php
$hashed = password_hash("admin123", PASSWORD_DEFAULT);
echo "Hashed password: " . $hashed;
?>
