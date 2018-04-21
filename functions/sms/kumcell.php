<?php
  class SMS_Api {
      public $username ;
      public $password ;
      public $credentials;
      public $url ;
      public $soap_request  ;

      public function __construct($username, $password) {
          $this->username = $username;
          $this->password = $password;
          $credentials = $username .":". $password;
      }

      public function xmlConfig() {
          $header = array(
            "Content-type: text/xml",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: '" . $this->url . "'",
            "Content-length: ".strlen($this->soap_request),
          );

          $curl = curl_init();

          curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC) ;
          curl_setopt($curl, CURLOPT_USERPWD, $this->credentials);
          curl_setopt($curl, CURLOPT_SSLVERSION,3);
          curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
          curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
          curl_setopt($curl, CURLOPT_POST, 1);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $this->soap_request);
          curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
          curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
          curl_setopt($curl, CURLOPT_URL, $this->url);

          $xml_result = curl_exec($curl);

          if ($xml_result === false) {
            $error_occurred = true;
          }
          else {
            print_r($xml_result);
          }
      }

      public function getBalance() {
          $this->url = "http://sms.kumcell.com/Api/GetBalance";
          $this->soap_request = "<GetBalance xmlns:i='http://www.w3.org/2001/XMLSchema-instance' xmlns='SmsApi'>
                                    <Credential>
                                          <Password>" . $this->password . "</Password>
                                          <Username>" . $this->username . "</Username>
                                    </Credential>
                                 </GetBalance>";
          $this->xmlConfig();
      }

      public function getQuery($msisdn, $messageID) {
          $this->url = "http://sms.kumcell.com/Api/Query";
          $this->soap_request = "<Query xmlns:i='http://www.w3.org/2001/XMLSchema-instance' xmlns='SmsApi'>
                                   <Credential>
                                        <Password>" . $this->password . "</Password>
                                        <Username>" . $this->username . "</Username>
                                   </Credential>
                                   <MSISDN>" . $msisdn . "</MSISDN>
                                   <MessageId>" . $messageID . "</MessageId>
                                </Query>";
          $this->xmlConfig();
      }

      public function submit($title, $message, $numberArray) {
          $numberContent = "";
          foreach ($numberArray as &$x) {
              $numberContent .= "<d2p1:string>" . $x . "</d2p1:string>";
          }
          $this->url = "http://sms.kumcell.com/Api/Submit";
          $this->soap_request = "<Submit xmlns:i='http://www.w3.org/2001/XMLSchema-instance' xmlns='SmsApi'>
                                   <Credential>
                                        <Password>" . $this->password . "</Password>
                                        <Username>" . $this->username . "</Username>
                                   </Credential>
                                   <DataCoding>Default</DataCoding>
                                   <Header>
                                        <From>" . $title . "</From>
                                        <ScheduledDeliveryTime></ScheduledDeliveryTime>
                                        <ValidityPeriod>0</ValidityPeriod>
                                   </Header>
                                   <Message>" . $message . "</Message>
                                   <To xmlns:d2p1='http://schemas.microsoft.com/2003/10/Serialization/Arrays'>"
                                   . $numberContent .
                                   "</To>
                                 </Submit>";
          $this->xmlConfig();
      }

      public function submitMulti($title, $numberMessageArray) {
          $numberContent = "";
          for ($row = 0; $row < sizeof($numberMessageArray); $row++) {
            $numberContent .= "<Envelope><Message>" . $numberMessageArray[$row][1] . "</Message><To>" . $numberMessageArray[$row][0] . "</To></Envelope>";
          }
          $this->url = "http://sms.kumcell.com/Api/SubmitMulti";
          $this->soap_request = "<SubmitMulti xmlns:i='http://www.w3.org/2001/XMLSchema-instance' xmlns='SmsApi'>
                                   <Credential>
                                        <Password>" . $this->password . "</Password>
                                        <Username>" . $this->username . "</Username>
                                   </Credential>
                                   <DataCoding>Default</DataCoding>
                                   <Header>
                                        <From>" . $title . "</From>
                                        <ScheduledDeliveryTime></ScheduledDeliveryTime>
                                        <ValidityPeriod>0</ValidityPeriod>
                                   </Header>
                                   <Envelopes>"
                                   . $numberContent .
                                   "</Envelopes>
                                 </SubmitMulti>";
          $this->xmlConfig();
      }
  }

  $instance = new SMS_Api("username", "password");
  echo $instance->getBalance();
  echo "<br>-----<br>";
  //echo $instance->getQuery("905453251571", '1');
  echo $instance->submit("Company Name", "Hello there", array("905453251570"));
  //echo $instance->submitMulti("Comp Name", array(array("905453251570", "test1"), array("905453251569", "test2")));


?>
