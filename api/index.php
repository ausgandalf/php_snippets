<!DOCTYPE html>
<html>
<head>
    <title>Attendance API Test</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Fetch Attendance Data</h2>
    <form id="attendanceForm" action="api.php">
        <label for="courseid">Course ID:</label>
        <input type="text" id="courseid" name="courseid" required>
        <button type="submit">Fetch</button>
    </form>
    <pre id="result"></pre>

    <script>
        $('#attendanceForm').on('submit', function(e) {
            e.preventDefault();
            $.post('', $(this).serialize(), function(data) {
                $('#result').text(JSON.stringify(data, null, 2));
            });
        });
    </script>
</body>
</html>
