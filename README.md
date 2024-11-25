# module-marketplace
# Installation

Adobe Commerce Marketplace Multi Seller module installation is very easy, please follow the steps for installation-

1. Unzip the respective extension zip and create hts(vendor) and Marketplace(module) name folder inside your AdobeCommerce/app/code/ directory and then move all module's files into Adobe commerce root directory AdobeCommerce/app/code/Hts/Marketplace/ folder.

Run Following Command via terminal
-----------------------------------
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy

2. Flush the cache and reindex all.

Now module is properly installed, Happy Coding!!
