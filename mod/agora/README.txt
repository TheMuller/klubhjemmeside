******* Agora Classifieds Plugin *******

Elgg plugin for posting classifieds to community members using Paypal Payment Gateway.

Administrator can set who can post classifieds in settings. If all members can post classifieds, then their personal email account (in settings) will be used as Paypal Account.

== Contents ==
1. Features
2. Installation
3. ToDo

== 1. Features ==
- Members are able to create classifieds/listing posts
- Post classifieds with several features:
- - Option to sell online units using Paypal gateway
- - Ad title and description
- - Ad location
- - Price and currency
- - No of available units
- - Photo of ad unit
- - Tags, comments, access level
- Unlimited number of classifieds
- Unlimited number of classifieds categories
- Map of Claddifieds with search options, if enabled by administrator 
- Members must accept terms of use before posting ads (if enabled by administrator)
- Online members can use Paypal for buying online products or services (if price is set by seller)
- Buyer and seller receive notifications for Paypal transaction
- Automatically reduce the number of available units once payment is completed
- Automatically disable the classified if all the available units are sold out
- Option for posting classifieds in groups
- List view and gallery view of classifieds
- Widget on users profile for showing of their latest classifieds
- Widget on users profile displaying recent bought and sold items of user
- Option to send private message to the seller (if enabled by administrator)
- WYSIWYG editing of product descriptions
- River announcements with image
- Notifications are send for each transaction to users specified by administrator
- Transactions log list in admin area
- English, French, Spanish and Greek Language
- Configuration options:
- - define classfieds categories 
- - set permissions for posting ads (admin or all members)
- - default currency
- - terms of use
- - enable/disable "Send private message" button
- - set Paypal account (for administrator)
- - use Paypal Sandbox (test mode) 


== 2. Installation ==
Requires: Elgg 1.8 or higher

1. Upload kanelggamapsapi plugin in "/mod/" elgg folder and activate it.  In "Administration/Configure/Settings/Kanelgga Maps API" you must configure basic map options
2. Upload classifieds plugin in "/mod/" elgg folder and activate it
3. In "Administration/Configure/Settings/Agora Classifieds" you can configure several options
4. To change any of the dialog, words, and sentences, edit 'mod/agora/languages/en.php'
5. HTML email handler Plugin is suggested for sending html emails (http://community.elgg.org/plugins/709492/2.3.1/html-email-handler)
6. Ensure that images at 'mod/agora/graphics' and 'mod/kanelggamapsapi/graphics' are readable from web server


== 3. ToDo ==
- more images per classified
- rate the seller
- more search options
- wish list
- .....
