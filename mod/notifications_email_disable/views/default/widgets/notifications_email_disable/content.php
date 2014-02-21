<?php

echo '<div class="notifications-email-disable-wrapper">';
echo elgg_echo('notifiactions_email_disable:instructions');

echo "<br><br>";

echo elgg_view('input/plaintext', array('name' => 'invalid_emails', 'class' => 'notifications-emails-value'));

echo elgg_view('input/submit', array('value' => elgg_echo('submit'), 'class' => 'notifications-email-disable'));
echo '</div>';

echo elgg_view('graphics/ajax_loader', array('class' => 'notifications-email-disable-throbber'));