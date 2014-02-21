Original author of this plugin is  Anirup Dutta
https://github.com/anirupdutta/facebook_api

Plugin version 1.3
Please feel free to contact me @ chetanvarshney@gmail.com if you have any problem.
Demo at http://elgg.ektasoftwares.com


Please follow these steps to use facebook connect with your elgg site

Go to this article to create your facebook application
http://www.chetanvarshney.com/social-media/facebook/facebook-application-for-facebook-connect-plugin/?preview=true&preview_id=111&preview_nonce=a0f52c891f

1. Copy faceook connect in mod folder and make sure plugin folder name is facebook_connect
2. Login with your admin account and activate facebook connect plugin
3. Now Click on Setting and enter your facebook application api key and secret no
4. You can set other setting also
5. Now you can see facebook login button on login page



If Facebook user is already registered on your network then this pluging will associate site account with facebook account 
otherwise this plugin will auto register the facebook user and send login details to user email address.







Fixes-
@ version 1.1
1. Plugin sends login details to facebook user's email address.


@ version 1.2
1. update email ids of old facebook connect users(before this plugin)
2. If site page are restricted to logged in users then facebook connect plugin works in this version
3. facebook permission requests are decreased now plugin requests for needed permissions to facebook


@ version 1.3
1. facebook api changes
2. no fatal error any where
3. Admin banned users can not login with facebook (Please note deleted users can register with facebook)
4. User can revoke facebook access from his/her account
5. Existing User can also attach facebook with his/her account
6. Admin can enable or disable post on facebook(account synchronized status post on facebook only for new users)