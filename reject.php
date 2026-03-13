<?php
require 'config.php';
$id = (int)($_GET['id'] ?? 0);
if($id){
  $conn->query("UPDATE donations_details SET status='REJECTED' WHERE id=$id");
}
echo "Donation rejected.";
