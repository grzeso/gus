<?php

          echo "<pre>";

            $phpunit_test_config = array(
                'ws-security-login' => 'operon.pl',
                'ws-security-password' => 'G45*!c532T',
                'instance' => 'production'
              );

              require_once ('teryt/TERYT_Webservices.php');
              require_once ('teryt/TERYT_SoapClient.php');

            $client = new TERYT_Webservices('operon.pl', 'G45*!c532T', 'production', true);


        $vv = $client -> provinces();          
        var_Dump($client);        
        var_Dump($vv);
        
        
       $client  = new TERYT_SoapClient('https://uslugaterytws1.stat.gov.pl/wsdl/terytws1.wsdl',$phpunit_test_config);
  
        var_Dump($client);
  
      $vv =  $client->PobierzListeWojewodztw(array(
        'DataStanu' => '2019-01-01'
      ));
      
       
       var_Dump($vv);
     
