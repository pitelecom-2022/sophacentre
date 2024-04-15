<?php
require "vendor/autoload.php";
$ami = new \PHPAMI\Ami();
   if ($ami->connect('localhost:5038', 'cron', '2bxsc58v', 'off') === false) {
      throw new \RuntimeException('Could not connect to Asterisk Management Interface.');
   }
   
   // // if you have a looping of command function
   // // set allowTimeout flag to true
   // $ami->allowTimeout();

   // $result contains the output from the command
$result = $ami->command('Action: Originate Application: Dial Data: SIP/101');
print_r($result);
   
   $ami->disconnect();
?>
