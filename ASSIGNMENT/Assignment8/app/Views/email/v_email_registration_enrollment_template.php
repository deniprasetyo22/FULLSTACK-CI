<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Email</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .header {
            background-color: #f5f5f5;
            padding: 10px;
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        .footer {
            background-color: #f5f5f5;
            padding: 10px;
            text-align: center;
            font-size: 12px;
        }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="header">
                <h1>Notification Email</h1>
            </div>
            <div class="content">
                <h2>Hello, <?= $name ?></h2>
                <p><?= $content ?></p>
                <p>Thanks for read this email.</p>

                <div class="card mb-4">
                    <div class="card-header">
                        <strong>Data :</strong>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <?php foreach ($features as $feature): ?>
                            <li><?= $feature ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer">
                <p>This email was sent automatically. Please do not reply.</p>
                <p>&copy; <?= date('Y') ?> Academic Management System</p>
            </div>
        </div>
    </body>

</html>