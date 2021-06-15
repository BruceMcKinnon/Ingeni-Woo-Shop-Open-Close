=== Ingeni Woo Shop Open ===

Contributors: Bruce McKinnon
Tags: woocommerce, seo
Requires at least: 4.8
Tested up to: 5.1.1
Stable tag: 2021.04

Used in conjunction with Woocommerce. Allows the woo shop to be quickly closed or opened.

== Description ==

* - Used in conjunction with Woocommerce. 

* - Allows the woo shop to be quickly closed or opened.




== Installation ==

1. Upload the 'ingeni-woo-product-meta’ folder to the '/wp-content/plugins/' directory.

2. Activate the plugin through the 'Plugins' menu in WordPress.




== Frequently Asked Questions ==


Q - I can still see products in the store.

A - The plugin added two additional DIVs on the store and product pages:

<div class="shop_closed">

and:

<div class="shop_closed_after">


Your themes CSS can use these classes to hide store content. For example:

.shop_closed {
    display: none;
}
.shop_closed_after {
    margin: 100px 0;
}
.shop_closed_after::after {
    content: "Sorry, our online store is temporarily closed.";
    font-size: rem-calc(36);
    text-align: center;
}





== Changelog ==

v2017.01 - Initial version

v2021.01 - Fixed an issue with loading the plugins CSS file.

v2021.02 - Fixed the Github update checking URL.

v2021.03 & 2021.04 - Released by mistake. No changes over v2021.02.



