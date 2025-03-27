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

        .list-unstyled {
            list-style: none;
            padding: 0;
        }

        .image-preview {
            margin-top: 10px;
            text-align: center;
        }

        .image-preview img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            padding: 5px;
            background: #f9f9f9;
        }

        .image-link {
            color: blue;
            text-decoration: underline;
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
                <p>Thanks for reading this email.</p>

                <?php if (!empty($features)): ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <strong>Product Details:</strong>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><strong>Name:</strong> <?= $features['name'] ?></li>
                            <li><strong>Description:</strong> <?= $features['description'] ?></li>
                            <li><strong>Price:</strong> Rp.<?= number_format($features['price'], 2) ?></li>
                            <li><strong>Stock:</strong> <?= $features['stock'] ?></li>
                            <li><strong>Category:</strong> <?= $features['category'] ?></li>
                            <li><strong>Product Link:</strong>
                                <a class="image-link" href="<?= $features['link'] ?>" target="_blank">View</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="footer">
                <p>This email was sent automatically. Please do not reply.</p>
                <p>&copy; <?= date('Y') ?> Academic Management System</p>
            </div>
        </div>
    </body>

</html>