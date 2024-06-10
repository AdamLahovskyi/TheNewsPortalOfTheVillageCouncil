<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript">
        function redirectAfterDelay() {
            let count = 5;
            let countdownElement = document.getElementById('countdown');
            let countdownInterval = setInterval(function() {
                countdownElement.innerHTML = count--;
                if (count < 0) {
                    clearInterval(countdownInterval);
                    window.location.href = "/";
                }
            }, 1000);
        }

        window.onload = redirectAfterDelay;
    </script>
</head>
<body>
<div class="container text-center mt-5">
    <h1 class="display-1">Error!</h1>
    <p class="lead">An Error Occurred. Redirecting in <span id="countdown">5</span>...</p>
</div>
</body>
</html>
