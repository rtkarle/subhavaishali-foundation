
<?php
require 'config.php';

$res = $conn->query("SELECT * FROM donations_details ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin – Donations</title>
<style>
body{font-family:Inter, sans-serif;padding:20px;background:#f5f7fb}
table{border-collapse:collapse;width:100%;background:#fff;
      box-shadow:0 8px 20px rgba(0,0,0,0.08);}
th,td{padding:10px 12px;border:1px solid #ddd;font-size:14px}
th{background:#ffefe0;color:#333}
a.btn{padding:5px 10px;border-radius:6px;text-decoration:none;font-size:13px}
.approve{background:#2c9c3d;color:#fff}
.reject{background:#c82333;color:#fff}
</style>
</head>
<body>

<h2>Donation Requests</h2>

<table>
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Email</th>
  <th>Amount</th>
  <th>Screenshot</th>
  <th>Status</th>
  <th>Action</th>
</tr>

<?php while($row = $res->fetch_assoc()){ ?>
<tr>
  <td><?= $row['id'] ?></td>
  <td><?= htmlspecialchars($row['name']) ?></td>
  <td><?= htmlspecialchars($row['email']) ?></td>
  <td>₹<?= $row['amount'] ?></td>
  <td><a href="<?= htmlspecialchars($row['screenshot']) ?>" target="_blank">View</a></td>
  <td><?= $row['status'] ?></td>
  <td>
     <?php if($row['status'] === 'PENDING'){ ?>
        <a class="btn approve" href="approve.php?id=<?= $row['id'] ?>">Approve</a>
        <a class="btn reject" href="reject.php?id=<?= $row['id'] ?>">Reject</a>
     <?php } else { echo "-"; } ?>
  </td>
</tr>
<?php } ?>

</table>

</body>
</html>
