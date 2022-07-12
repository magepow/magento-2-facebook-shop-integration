# Magento 2 Facebook Shop Integration

Magento 2 Facebook Shop Integration extension synchronizes Magento 2 store products with the Facebook shop and facilitates to sell on Facebook.

Before you continue, ensure you meet the following requirements:

  * You have installed Magento 2.
  * You are using a Linux or Mac OS machine. Windows is not currently supported.

[![Latest Stable Version](https://poser.pugx.org/magepow/facebookshopintegration/v/stable)](https://packagist.org/packages/magepow/facebookshopintegration)
[![Total Downloads](https://poser.pugx.org/magepow/facebookshopintegration/downloads)](https://packagist.org/packages/magepow/facebookshopintegration)
[![Daily Downloads](https://poser.pugx.org/magepow/facebookshopintegration/d/daily)](https://packagist.org/packages/magepow/facebookshopintegration)

## 1. Download Magento 2 Product Tags

 ### Install via composer (recommend).
Run the following commands in Magento 2 root folder:
```
composer require magepow/facebookshopintegration
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy -f
```

## 2. User guide
   #### Key features of Magento 2 Facebook Shop Integration Extension:

  * Integrates store products with the Facebook shop.
  * Redirect customers directly from the shop on Facebook to payment in the Magento 2 store.
  * Bulk product upload via CSV in the admin config.
  * Use the "Add New Mapping" button to create new attribute mapping for the required and other missing fields.
  * The required fields for which the extension cannot create the mapping, create it by adding new attribute code.
  * Select the Facebook attribute code and the Magento attribute code to add a new mapping for Facebook fields.
  * The "Product Feed CSV Log" grid lists the CSV generation log details like start date, finished at, triggered by, product IDs, status and message.
  ### 2.1. General configuration

  `Login to Magento Admin > Magepow > Configurations > General Configuration.`
  
  ![Image of Magento admin config](https://github.com/magepow/magento-2-facebook-shop-integration/blob/main/media/admin_config.png)
  * Generate CSV for Facebook Shop: Choose Yes to create a product CSV automatically according to settings.
  * Generate CSV on Schedule: Show/hide Show number of products beside tags.
  * Frequency of Schedule CSV: Set the frequency to schedule automatic product CSV generation by day, month, or year.
  * Time of Schedule CSV: Set the time for schedule automatic product csv generation. 
  * Apply Catalog Price Rules: Select Yes to apply catalog price rules for product prices on facebook.
  * Add Out Of Stock Products to CSV: Select Yes to display out of stock products on facebook.

  ### 2.3. List Facebook attribute and add new attribute Facebook shop integration.

   `Login to Magento Admin > Magepow > Facebook Attribute Mapping > Add New Attribute, choose the Facebook attribute code and Magento attribute code you want => Click Save.`
   ![Image of Magento admin config](https://github.com/magepow/magento-2-facebook-shop-integration/blob/main/media/add_new_attribute.png)
   * After when add a new attribute and save will backlist facebook attribute mapping. you can edit, delete, and mass deletes the facebook attribute mapping.
   ![Image of Magento admin config](https://github.com/magepow/magento-2-facebook-shop-integration/blob/main/media/facebook_attribute.png)
  ### 2.4. Add products and google product category.

  `Login to Magento Admin > Catalog > Products > Choose edit products > Facebook Shop Integration.`
  ![Image of Magento admin config](https://github.com/magepow/magento-2-facebook-shop-integration/blob/main/media/add_product_on_facebook.png)
  * Show Product On Facebook: Choose yes to display products on the Facebook shop.
  * Facebook Product Condition: Product condition for the product in a Facebook shop. Select new, refurbished, used (fair), used (good), and used (like new).
  *  Google Product Category: Set product item category based on standard taxonomy defined by Google: https://support.google.com/merchants/answer/6324436. You can specify either the string representation or the numeric representation of your category.
  `Login to Magento Admin > Catalog > Categories > Choose category > Facebook Shop Integration.`
  ![Image of Magento admin config](https://github.com/magepow/magento-2-facebook-shop-integration/blob/main/media/add_product_on_facebook.png)
  * Google Product Category: Set category based on standard taxonomy defined by Google: https://support.google.com/merchants/answer/6324436. You can specify either the string representation or the numeric representation of your category.
  ### 2.5. Facebook feed CSV Log
  * When configuring, add product and google product category, we create CSV file by.
  `Login to Magento Admin > Magepow > Configurations > General Configuration > Generate CSV for Facebook Shop > Click Generate CSV.`
  * After generating the file CSV it will save in the Facebook feed CSV log.
  ![Image of Magento storefront](https://github.com/magepow/magento-2-facebook-shop-integration/blob/main/media/product_feed_csvlog.png)
  ### 2.6. Facebook commerce manager and Facebook store.
  * [Commerce_manager](https://www.facebook.com/commerce_manager/)
  Step 1: Click Catalog_products.
  ![Image of Magento storefront](https://github.com/magepow/magento-2-facebook-shop-integration/blob/main/media/config_facebook.png)
  Step 2: Click add items.
  ![Image of Magento storefront](https://github.com/magepow/magento-2-facebook-shop-integration/blob/main/media/add_items.png)
  Step 3: Data Source.
  ![Image of Magento storefront](https://github.com/magepow/magento-2-facebook-shop-integration/blob/main/media/data_sources.png)
  Step 4: Choose upload option.
  ![Image of Magento storefront](https://github.com/magepow/magento-2-facebook-shop-integration/blob/main/media/choose-upload-option.png)
  Step 5: Choose file upload.
  ![Image of Magento storefront](https://github.com/magepow/magento-2-facebook-shop-integration/blob/main/media/choose-file.png)
  Step 6: Complete settings, find and verify uploaded products as shown below.
  ![Image of Magento storefront](https://github.com/magepow/magento-2-facebook-shop-integration/blob/main/media/products-upload.png)
  * Product details in facebook shop.
  ![Image of Magento storefront](https://github.com/magepow/magento-2-facebook-shop-integration/blob/main/media/details_.png)
  * On clicking of the “Checkout on website”, it will add the product to the cart and redirect the Facebook user to your website.
    ![Image of Magento storefront](https://github.com/magepow/magento-2-facebook-shop-integration/blob/main/media/checkout_.png)
 ## Donation

If this project help you reduce time to develop, you can give me a cup of coffee :).

[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/paypalme/alopay)

      
**[Our Magento 2 Extensions](https://magepow.com/magento-2-extensions.html)**

* [Magento 2 Recent Sales Notification](https://magepow.com/magento-2-recent-sales-notification.html)

* [Magento Categories Extension](https://magepow.com/magento-categories-extension.html)

* [Magento Sticky Cart](https://magepow.com/magento-sticky-cart.html)

* [Magento Ajax Contact](https://magepow.com/magento-ajax-contact-form.html)

* [Magento Lazy Load](https://magepow.com/magento-lazy-load.html)

* [Magento 2 Mutil Translate](https://magepow.com/magento-multi-translate.html)

* [Magento 2 Instagram Integration](https://magepow.com/magento-2-instagram.html)

* [Lookbook Pin Products](https://magepow.com/lookbook-pin-products.html)

* [Magento Product Slider](https://magepow.com/magento-product-slider.html)

* [Magento Product Banner](https://magepow.com/magento-banner-slider.html)

**[Our Magento services](https://magepow.com/magento-services.html)**

* [PSD to Magento 2 Theme Conversion](https://magepow.com/psd-to-magento-theme-conversion.html)

* [Magento Speed Optimization Service](https://magepow.com/magento-speed-optimization-service.html)

* [Magento Security Patch Installation](https://magepow.com/magento-security-patch-installation.html)

* [Magento Website Maintenance Service](https://magepow.com/website-maintenance-service.html)

* [Magento Professional Installation Service](https://magepow.com/professional-installation-service.html)

* [Magento Upgrade Service](https://magepow.com/magento-upgrade-service.html)

* [Customization Service](https://magepow.com/customization-service.html)

* [Hire Magento Developer](https://magepow.com/hire-magento-developer.html)

**[Our Magento Themes](https://alothemes.com/)**

* [Expert Multipurpose Responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/expert-premium-responsive-magento-2-and-1-support-rtl-magento-2-/21667789)

* [Gecko Premium Responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/gecko-responsive-magento-2-theme-rtl-supported/24677410)

* [Milano Fashion Responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/milano-fashion-responsive-magento-1-2-theme/12141971)

* [Electro 2 Responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/electro2-premium-responsive-magento-2-rtl-supported/26875864)

* [Electro Responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/electro-responsive-magento-1-2-theme/17042067)

* [Pizzaro Food responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/pizzaro-food-responsive-magento-1-2-theme/19438157)

* [Biolife organic responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/biolife-organic-food-magento-2-theme-rtl-supported/25712510)

* [Market responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/market-responsive-magento-2-theme/22997928)

* [Kuteshop responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/kuteshop-multipurpose-responsive-magento-1-2-theme/12985435)

* [Bencher - Responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/bencher-responsive-magento-1-2-theme/15787772)

* [Supermarket Responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/supermarket-responsive-magento-1-2-theme/18447995)

**[Our Shopify Themes](https://themeforest.net/user/alotheme)**

* [Dukamarket - Multipurpose Shopify Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/dukamarket-multipurpose-shopify-theme/36158349)

* [Ohey - Multipurpose Shopify Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/ohey-multipurpose-shopify-theme/34624195)

* [Flexon - Multipurpose Shopify Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/flexon-multipurpose-shopify-theme/33461048)

**[Our Shopify App](https://apps.shopify.com/partners/maggicart)**

* [Magepow Size Chart](https://apps.shopify.com/magepow-size-chart)

**[Our WordPress Theme](https://themeforest.net/user/alotheme/portfolio)**

* [SadesMarket - Multipurpose WordPress Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/sadesmarket-multipurpose-wordpress-theme/35369933)
