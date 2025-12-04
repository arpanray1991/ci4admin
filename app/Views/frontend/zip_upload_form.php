<!DOCTYPE html>
<html>
<head>
    <title>Upload ZIP Excel</title>
</head>
<body>
    <h2>Upload ZIP Excel File</h2>
    <form action="<?= base_url('process_excel'); ?>" method="post" enctype="multipart/form-data">
        <label>Area Name:</label>
        <input type="text" name="area_name" required>
        <br><br>
        <label>Excel File (ZIPs in first column):</label>
        <input type="file" name="excel_file" required>
        <br><br>
        <button type="submit">Process</button>
    </form>
</body>
</html>
