<!DOCTYPE html>
<?php 
    require_once ('pobierz.php');
?>

<html>

<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/normalize.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

  <h3>Wybierz województwo</h3>  
  
    <div class="form-group">
        <div class="row my-1">
            <div class="col-6">
                <select id="rok" class="form-control">
                    <option>2011</option>
                    <option>2020</option>
                </select> 
            </div>
        </div>
        <div class="row my-1">
            <div class="col-6">
                <select id="wojewodztwa" class="form-control"></select> 
            </div>
        </div>
        <div class="row my-1">
            <div class="col-6">
                <select id="powiaty" class="form-control"></select> 
            </div>
        </div>
        <div class="row my-1">
            <div class="col-6">
                <select id="gminy" class="form-control"></select>  
            </div>
        </div>
        <div class="row my-1">
            <div class="col-6">
                <select id="miasta" class="form-control"></select> 
            </div>
        </div>        
        <div class="row my-1">
            <div class="col-6">
                <select id="ulice" class="form-control"></select> 
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
</body>

</html>