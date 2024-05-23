<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evNxOUQCT79PpJrYLbAELcX3zUbx9CnXL9EUYKzONQW/zC832LKzis9R0N/Ouk4T" crossorigin="anonymous">
    <style>
        .sidebar {
            background-color: #f5f5f5;
            /* Light gray background */
            padding: 10px;
        }

        .main-content {
            padding: 20px;
        }

        .header {
            background-color: #eee;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <h3>Admin Menu</h3>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Settings</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 main-content">
                <div class="header">
                    <h1>Welcome, Admin!</h1>
                </div>
                <p>This is the main content area where you can see different admin sections.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OgwbZS7/BXzYhFOT11tTznCtq7zYjLNUovqESGruoD8sJKplHsQxidulGhzqS1MQ" crossorigin="anonymous">
    </script>
</body>

</html>