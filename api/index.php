<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FlashPoint API Client</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(function () {
      $('#submitBtn').on('click', function () {
        $.ajax({
          url: 'api.php',
          method: 'POST',
          data: {
            courseid: $('#courseid').val(),
            action: 'attendance'
          },
          success: function (response) {
            $('#response').text(JSON.stringify(response, null, 2));
          },
          error: function (xhr) {
            $('#response').text('Error: ' + xhr.responseText);
          }
        });
      });
    });
  </script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 p-6">
  <div class="max-w-xl mx-auto bg-white shadow-md rounded p-6">
    <h1 class="text-2xl font-bold mb-4">FlashPoint Attendance API</h1>

    <label class="block mb-2">
      Course ID
      <input id="courseid" type="text" class="w-full mt-1 p-2 border rounded" />
    </label>

    <button id="submitBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
      Fetch Attendance
    </button>

    <pre id="response" class="mt-6 bg-gray-200 p-4 rounded overflow-x-auto"></pre>
  </div>
</body>
</html>
