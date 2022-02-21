<?php
        // echo "Your IP Address is".$_POST["ipaddress"];

    if(isset($_POST["ipaddress"]))
    {
        // echo "Your IP Address is".$_POST["ipaddress"];
        
        $ticket=$blacklist=$json_blacklist=$json_output=$output="";
        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "https://mx-01.accessworld.net:8006/api2/json/access/ticket");
        curl_setopt($ch, CURLOPT_POSTFIELDS,
        "username=api-auditor@pmg&password=S]S2V8-ay2B\}Hev");
        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);
        $json_output= json_decode($output,true);
        //   var_dump($json_output["data"]);
        $ticket= $json_output["data"]["ticket"];
        // close curl resource to free up system resources
        curl_close($ch);   

        $blklst= curl_init();
        curl_setopt($blklst, CURLOPT_URL, "https://mx-01.accessworld.net:8006/api2/json/config/ruledb/who/31/objects");
        curl_setopt($blklst, CURLOPT_HTTPHEADER, array("Cookie: PMGAuthCookie=$ticket"));
        curl_setopt($blklst, CURLOPT_RETURNTRANSFER, 1);
        $blacklist = curl_exec($blklst);

        // var_dump(substr_replace($blacklist, "",-1));
        curl_close($blklst);
        // var_dump($blacklist);
        $json_blacklist= json_decode($blacklist,true);
        $blacklist_list= $json_blacklist['data'];
        foreach ($blacklist_list as $blocked){
                // var_dump($blocked);
                // echo "<br>";

                if($blocked['otype_text']=="IP Address")
                {
                    if($blocked['ip']==$_POST["ipaddress"]){
                        $blacklisted="TRUE";
                        break;
                    }else{
                        $blacklisted="FALSE";
                    }
                    // echo "<tr><td>IP Address</td><td>". $blocked['ip']."</td></tr>";
                }
                // }elseif($blocked['otype_text']=="IP Network"){
                //     echo "<tr><td>IP Network</td><td>". $blocked['cidr']."</td></tr>";
                // }
        }
        
                     

    }


?>

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
        <?php
            if(isset($_POST["ipaddress"])){
                if($blacklisted=="TRUE"){
                    echo "You Are Blacklisted. Your IP is: ".$_POST['ipaddress'];
                }elseif($blacklisted=="FALSE"){
                    echo "You Are Not Blacklisted";
                }
            }
        ?>
       <button class="btn btn-primary" onClick="location.href='index.php'">Check Another IP</button>
       
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
            text-align: center;
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
            margin-top:20px;
            display:block;
        }
    </style>
    <script>
       function ValidateIPaddress(inputText)
        {
            var ipformat = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
            if(inputText.value.match(ipformat))
            {
                document.form1.text1.focus();
                return true;
            }
            else
            {
                alert("You have entered an invalid IP address!");
                document.form1.text1.focus();return false;
            }
        }
    </script>
</body>
</html>
