```php
<?php
// melihat hasil query
    include 'connect.php';
    $query = 'SHOW CREATE TABLE komentar_warga';
    $result = mysqli_query($conn, $query);
    if (!$result) {
        $error = mysqli_error($conn);
        die("Error: $error");
    } else {
        $row = mysqli_fetch_row($result);
        $createTableQuery = $row[1];
        echo $createTableQuery;
    }
?>
