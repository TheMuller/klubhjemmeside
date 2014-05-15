closable User message at the top of the page.
--------------------

NOTES FOR DEVELOPERS:


$param = array(
		'msg'=>'This is demo message,thankyou',
		'is_form'=>false,
		'form_params'=>array(),
		'body_params'=>array(),
         );
    
create_user_message("create",$param );
this will show  'msg' as HTML text cotent of  the user message.


$param = array(
		'msg'=>'yourplugin/default/views/something/something',
		'is_form'=>true,
		'form_params'=>array(),
		'body_params'=>array(),
         );
    
create_user_message("create",$param );
there should be a  view file existing  the same path mentined in 'msg' field. 
do not put the view inside form, and do not put submit button.
there should be a action defined with the same name as specified in 'msg' field.


'when' =>'thispage'
the usermessage is preambled with current page.
'when' =>'thissession'
the usermessage is preabled with all the pages untill this session expires.
'when' =>'nextlogin'
the usermessage is preabled with all the pages untill session expires. but effective only after next login.

You need not to be in loggedin state while creating this messages. 
neither there is access control about who can set the message.
