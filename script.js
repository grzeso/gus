var val = window.location.href;
var nazwaMetody = val.substr(val.indexOf("?") + 1);

if(window.location.href == nazwaMetody){    
    $.ajax({
        url: "pobierz.php?getWojewodztwa", 
        data: {},
        type: "POST",
        success: function(result){
//            console.log(result);

            var json = JSON.parse(result);

//            console.log(json);

            var myOptions = json["wojewodztwa"]["PobierzListeWojewodztwResult"]["JednostkaTerytorialna"];
            var mySelect = $('#wojewodztwa');
            $.each(myOptions, function(val, text) {
                mySelect.append(
                    $('<option></option>').val(text['WOJ']).html(text['NAZWA'])
                );
            });
        }   
    });
}

$('body').on({click: function(){        
        getPowiaty($('#wojewodztwa').val());
}
},'#wojewodztwa');

$('body').on({click: function(){        
        getGminy($('#wojewodztwa').val(),$('#powiaty').val());
}
},'#powiaty');

$('body').on({click: function(){        
        getMiasta($('#wojewodztwa').val(),$('#powiaty').val(),$('#gminy').val(),$('#gminy option:selected').attr('rodzaj'));
}
},'#gminy');

$('body').on({click: function(){        
        getUlice($('#wojewodztwa').val(),$('#powiaty').val(),$('#gminy').val(),$('#gminy option:selected').attr('rodzaj'),$('#miasta').val());
}
},'#miasta');

$('body').on({change: function(){        
        $('#powiaty').find('option').remove();
        $('#gminy').find('option').remove();
        $('#miasta').find('option').remove();
        $('#ulice').find('option').remove();
}
},'#rok');

function getPowiaty(id){
//    console.log("getPowiaty");
    $.ajax({
        url: "pobierz.php?getPowiaty", 
        data: {id: id, rok:$('#rok').val() },
        type: "POST",
        success: function(result){
//            console.log(result);

            var json = JSON.parse(result);

//            console.log(json);
            $('#powiaty').find('option').remove();
            $('#gminy').find('option').remove();
            $('#miasta').find('option').remove();
            $('#ulice').find('option').remove();

            var myOptions = json["powiaty"]["PobierzListePowiatowResult"]["JednostkaTerytorialna"];
            var mySelect = $('#powiaty');
            $.each(myOptions, function(val, text) {
                mySelect.append(
                    $('<option></option>').val(text['POW']).html(text['NAZWA'])
                );
            });
        }   
    });
}
    
    
function getGminy(idWoj, idPow){
//     console.log("getGminy");
    $.ajax({
        url: "pobierz.php?getGminy", 
        data: {idWoj: idWoj, idPow:idPow, rok:$('#rok').val() },
        type: "POST",
        success: function(result){
//            console.log(result);

            var json = JSON.parse(result);

//            console.log(json);
            $('#gminy').find('option').remove();
            $('#miasta').find('option').remove();
            $('#ulice').find('option').remove();

            if($.isArray(json["gminy"]["PobierzListeGminResult"]["JednostkaTerytorialna"])){
                var myOptions = json["gminy"]["PobierzListeGminResult"]["JednostkaTerytorialna"];
            } else {
                var myOptions = json["gminy"]["PobierzListeGminResult"];
            }

            var wykluczoneRodzajeMiast = ["9"];

            var mySelect = $('#gminy');
            $.each(myOptions, function(val, text) {                
                if($.inArray( text['RODZ'], wykluczoneRodzajeMiast) == -1){
                        mySelect.append(
                             $('<option></option>').val(text['GMI']).attr("rodzaj",text['RODZ']).html(text['NAZWA']+" ("+text['NAZWA_DOD']+')')
                        );
                 }
            });
        }   
    });
    
}

function getMiasta(idWoj, idPow, idGmi,idRodz){
    console.log("getMiasta");
    console.log(idPow);
    
    $.ajax({
        url: "pobierz.php?getMiasta", 
        data: {idWoj: idWoj, idPow:idPow, idGmi:idGmi, idRodz:idRodz, rok:$('#rok').val() },
        type: "POST",
        success: function(result){
//            console.log(result);

            var json = JSON.parse(result);

            console.log(json);
            $('#miasta').find('option').remove();
            $('#ulice').find('option').remove();


            if($.isArray(json["miasta"]["PobierzListeMiejscowosciWRodzajuGminyResult"]["Miejscowosc"])){
                var myOptions = json["miasta"]["PobierzListeMiejscowosciWRodzajuGminyResult"]["Miejscowosc"];
            } else {
                var myOptions = json["miasta"]["PobierzListeMiejscowosciWRodzajuGminyResult"];
            }

            var mySelect = $('#miasta');
            $.each(myOptions, function(val, text) {                
                if((idPow>60 && text['Nazwa'] == text['Powiat']) || idPow<=60 || (idPow>60 && text['Nazwa'] == text['Gmina'] ) ){
                        mySelect.append(
                            $('<option></option>').val(text['Symbol']).html(text['Nazwa'])
                        );
                 }
            });
            
            var arr = [""];
            
                    $('#miasta option').each(function() {
                
               
                
                arr.push( $(this).val());
                
                    console.log( "THIS");
                    console.log( $(this).val() );

                  });
            
            
           var max = Math.max.apply(Math, arr);
           console.log( "max");
           console.log( max);
           
        }   
    });    
}

function getUlice(idWoj, idPow, idGmi,idRodz,idMsc){
    
    $.ajax({
        url: "pobierz.php?getUlice", 
        data: {idWoj: idWoj, idPow:idPow, idGmi:idGmi, idRodz:idRodz, idMsc:idMsc, rok:$('#rok').val() },
        type: "POST",
        success: function(result){
//            console.log(result);

            var json = JSON.parse(result);

            console.log(json);
             $('#ulice').find('option').remove();

            var myOptions = json["ulice"]["PobierzListeUlicDlaMiejscowosciResult"]["UlicaDrzewo"];
            var mySelect = $('#ulice');
            $.each(myOptions, function(val, text) {
                mySelect.append(
                    $('<option></option>').val(text['Symbol']).html(text['Cecha']+" "+text['Nazwa1']+" "+text['Nazwa2'])
                );
            });
        }   
    });    
}
