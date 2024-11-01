<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Token</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Issue Access Token</h2>
        <form action="{{ route('issue.token') }}" method="POST">
            @csrf  <!-- Laravel CSRF token for security -->
            <div class="form-group">
                <label for="client_id">Client ID</label>
                <input type="text" class="form-control" id="client_id" name="client_id" required>
            </div>
            <div class="form-group">
                <label for="client_secret">Client Secret</label>
                <input type="text" class="form-control" id="client_secret" name="client_secret" required>
            </div>
            <div class="form-group">
                <label for="username">Email</label>
                <input type="email" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <input type="hidden" name="grant_type" value="password">
            <button type="submit" class="btn btn-primary">Issue Token</button>
        </form>
    </div>
</body>
</html>
