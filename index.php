

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessworld Email Gateway Blacklist</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <img class="img-fluid top-logo" src="https://email.accessworld.net/skins/_base/logos/LoginBanner_white.png?v=210621064452" alt="">
        <h3 class="header-title">Accessworld Tech Email Blacklist</h3>
    </header>
    <div class="container">
        
        <form name="checkblacklist" action="check.php" method="POST" onsubmit="return ValidateIPaddress(document.checkblacklist.ipaddress)">
            <div class="form-group">
                <label for="ipaddress">Enter Your IP Address</label>
                <input type="text" class="form-control" id="ipaddress" name="ipaddress" placeholder="IP Address">
            </div>
            <button type="submit" class="btn btn-primary" onclick="return ValidateIPaddress()">Submit</button>
        </form>
        <!-- <form name="form1" action="#"> 
                <input type='text' name='text1'/>
                
                <input type="submit" name="submit" value="Submit" onclick="ValidateIPaddress(document.form1.text1)"/>
            </ul>
        </form> -->
    </div>
    <style>
        body{
            background:#007CC3;
        }
        
        .container{
            max-width:800px;
            background: #fff;
            padding:20px;
            border-radius: 10px;
            box-shadow: 1px 1px 8px 1px #484646c4;
        }
        header{
            min-height:50px;
        }
        .top-logo{
            display: block;
            text-align:center;
            margin:0 auto;
            /* zoom:1.2; */
        }
        .header-title{
            color:#fff;
            text-align:center;
            margin-bottom: 20px;
            margin-top:10px;
        }
        form{
            max-width: 50%;
            margin: 0 auto;
            margin-top:20px;
            margin-bottom:20px;
        }
        .btn.btn-primary{
            margin: 0 auto;
            display:block;
        }
    </style>
    <script>
       function ValidateIPaddress()
        {
            var inputText =document.checkblacklist.ipaddress;
            var ipformat = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
            if(inputText.value.match(ipformat))
            {
                document.checkblacklist.ipaddress.focus();
                return true;
            }
            else
            {
                alert("You have entered an invalid IP address!");
                document.checkblacklist.ipaddress.focus();
                return false;
            }
        }
    </script>
</body>
</html>
