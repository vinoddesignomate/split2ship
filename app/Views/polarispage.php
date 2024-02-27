<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopify Polaris Sample App</title>
    <!-- Include Shopify Polaris CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@shopify/polaris@12.19.0/build/esm/styles.css">
</head>
<body>
    <div class="Polaris-Page">
        <div class="Polaris-Page__Header">
            <h1 class="Polaris-DisplayText Polaris-DisplayText--sizeLarge">Shopify Polaris Sample App</h1>
        </div>
        <div class="Polaris-Page__Content">
            <div class="Polaris-Card">
                <div class="Polaris-Card__Section">
                    <h2 class="Polaris-Heading">Products</h2>
                </div>
                <div class="Polaris-Card__Section">
                    <ul class="Polaris-List">
                        <?php
                        // Replace these values with your actual product data
                        $products = [
                            ['title' => 'Product 1', 'price' => 10.00],
                            ['title' => 'Product 2', 'price' => 20.00],
                            ['title' => 'Product 3', 'price' => 30.00]
                        ];
                        foreach ($products as $product):
                        ?>
                        <li class="Polaris-List__Item">
                            <div class="Polaris-Stack Polaris-Stack--spacingTight">
                                <div class="Polaris-Stack__Item">
                                    <p class="Polaris-TextStyle--headingMedium"><?php echo $product['title']; ?></p>
                                    <p class="Polaris-TextStyle--variationSubdued">$<?php echo $product['price']; ?></p>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Include Shopify Polaris JS (optional) -->
    <script src="https://sdks.shopifycdn.com/polaris/5.0.0/polaris.min.js"></script>
</body>
</html>