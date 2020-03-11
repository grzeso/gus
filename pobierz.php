<?php

if (strlen($_SERVER["QUERY_STRING"]) != 0 ){

    $nazwa = $_SERVER["QUERY_STRING"];
    
    $pobierz = new pobierz();
    $pobierz ->$nazwa();
}

class pobierz {    
    
    private $daneLogowania = array(
                'ws-security-login' => 'operon.pl',
                'ws-security-password' => 'G45*!c532T',
                'instance' => 'production'
              );
    
    public function getWojewodztwa(){
    
        require_once ('teryt/TERYT_Webservices.php');
        require_once ('teryt/TERYT_SoapClient.php');
                
        $client  = new TERYT_SoapClient('https://uslugaterytws1.stat.gov.pl/wsdl/terytws1.wsdl',$this -> daneLogowania);
  
        $wojewodztwaArr =  $client->PobierzListeWojewodztw(array(
          'DataStanu' => '2011-01-01'
        ));

        echo json_encode(["wojewodztwa" => $wojewodztwaArr]);
    }
    
    public function getPowiaty(){
        
        if(!isset($_POST['id'])){            
            die("Brak dostępu");            
        }

        require_once ('teryt/TERYT_Webservices.php');
        require_once ('teryt/TERYT_SoapClient.php');
                
        $client  = new TERYT_SoapClient('https://uslugaterytws1.stat.gov.pl/wsdl/terytws1.wsdl',$this -> daneLogowania);
  
        $powiatyArr =  $client->PobierzListePowiatow(array(
          'Woj' => $_POST['id'],
          'DataStanu' => $_POST['rok'].'-01-01'
        ));
        
        echo json_encode(["powiaty" => $powiatyArr]);
    }
    
    public function getGminy(){
        
        if(!isset($_POST['idWoj']) || !isset($_POST['idPow'])){            
            die("Brak dostępu");            
        }
        
        require_once ('teryt/TERYT_Webservices.php');
        require_once ('teryt/TERYT_SoapClient.php');
                
        $client  = new TERYT_SoapClient('https://uslugaterytws1.stat.gov.pl/wsdl/terytws1.wsdl',$this -> daneLogowania);
  
        $gminyArr =  $client->PobierzListeGmin(array(
          'Woj' => $_POST['idWoj'],
          'Pow' => $_POST['idPow'],
          'DataStanu' => $_POST['rok'].'-01-01'
        ));        
//        var_Dump($gminyArr);
  
        echo json_encode(["gminy" => $gminyArr]);
    }
    
    public function getMiasta(){
        
        if(!isset($_POST['idWoj']) || !isset($_POST['idPow']) || !isset($_POST['idGmi']) || !isset($_POST['idRodz'])){            
            die("Brak dostępu");            
        }
        
        require_once ('teryt/TERYT_Webservices.php');
        require_once ('teryt/TERYT_SoapClient.php');
                
        $client  = new TERYT_SoapClient('https://uslugaterytws1.stat.gov.pl/wsdl/terytws1.wsdl',$this -> daneLogowania);

        $miastaArr =  $client->PobierzListeMiejscowosciWRodzajuGminy(array(
          'symbolWoj' => $_POST['idWoj'],
          'symbolPow' => $_POST['idPow'],
          'symbolGmi' => $_POST['idGmi'],
          'symbolRodz' => $_POST['idRodz'],
          'DataStanu' => $_POST['rok'].'-01-01'
        ));        
//        var_Dump($miastaArr);
    
        echo json_encode(["miasta" => $miastaArr]);
    }
    
    public function getUlice(){
        
        if(!isset($_POST['idWoj']) || !isset($_POST['idPow']) || !isset($_POST['idGmi']) || !isset($_POST['idRodz']) || !isset($_POST['idMsc'])){            
            die("Brak dostępu");            
        }
        
        require_once ('teryt/TERYT_Webservices.php');
        require_once ('teryt/TERYT_SoapClient.php');
                
        $client  = new TERYT_SoapClient('https://uslugaterytws1.stat.gov.pl/wsdl/terytws1.wsdl',$this -> daneLogowania);

        $uliceArr =  $client->PobierzListeUlicDlaMiejscowosci(array(
          'woj' => $_POST['idWoj'],
          'pow' => $_POST['idPow'],
          'gmi' => $_POST['idGmi'],
          'rodzaj' => $_POST['idRodz'],
          'msc' => $_POST['idMsc'],
          'czyWersjaUrzedowa' => "true",
          'czyWersjaAdresowa' => "false",
          'DataStanu' => $_POST['rok'].'-01-01'
        ));        
//        var_Dump($uliceArr);
 
        echo json_encode(["ulice" => $uliceArr]);
    }
    
    
    public function getMiastaWoj(){        
        
        require_once ('teryt/TERYT_Webservices.php');
        require_once ('teryt/TERYT_SoapClient.php');
                
        $client  = new TERYT_SoapClient('https://uslugaterytws1.stat.gov.pl/wsdl/terytws1.wsdl',$this -> daneLogowania);
        
//        $dane =  $client->WyszukajJPT(array(
//          'nazwa' => "Rawa Mazowiecka"
//        ));
//        $dane =  $client->WyszukajMiejscowosc(array(
//          'nazwaMiejscowosci' => "Rawa Mazowiecka"
//        ));
        $dane =  $client->WyszukajMiejscowoscWJPT(array(
          'nazwaGmi' => "Rawa Mazowiecka"
        ));
        
        echo "<pre>";
        var_Dump($dane);
    }
    
}
