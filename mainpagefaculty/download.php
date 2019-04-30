<?php include 'index.php';?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Download files</title>
</head>
<body>

<table>
<thead>
    <th>ID</th>
    <th>Filename</th>
    <th>size (in mb)</th>
    <th>Downloads</th>
    <th>Action</th>
</thead>
<tbody>
  <?php foreach ($files as $file): ?>
    <tr>
      <td><?php echo $file[id]; ?></td>
      <td><a href="download.php?file_id=<?php echo $file['id'] ?>">Download</a></td>
    </tr>
  <?php endforeach;?>

</tbody>
</table>

</body>
</html>
