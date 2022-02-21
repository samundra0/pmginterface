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
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Block Type</th>
                    <th scope="col">Address</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                        $ticket=$blacklist=$json_blacklist=$json_output=$output="";
                    // create curl resource
                        $ch = curl_init();

                        // set url
                        curl_setopt($ch, CURLOPT_URL, "https://mx-01.accessworld.net:8006/api2/json/access/ticket");
                        curl_setopt($ch, CURLOPT_POSTFIELDS,
                        "username=api-auditor@pmg&password=Nepal1234$#@!#");
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
                        curl_setopt($blklst, CURLOPT_URL, "https://mx-01.accessworld.net:8006/api2/json/config/ruledb/who/02/objects");
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
                                // var_dump($blocked);
                                // echo "<tr><td>Email ID</td><td>". $blocked['email']."</td></tr>";

                                if($blocked['otype_text']=="Mail address")
                                {
                                    echo "<tr><td>Email Address</td><td>". $blocked['email']."</td></tr>";
                                }elseif($blocked['otype_text']=="Domain"){
                                    echo "<tr><td>Domain</td><td>". $blocked['domain']."</td></tr>";
                                }
                        }
                        // var_dump($json_blacklist["data"]);
                        // preg_match("/\{(.*)\}/",$json_blacklist,$match);
                        // var_dump(json_encode($match));
                        
                        


                ?>
            </tbody>
        </table>
    </div>
    <style>
        body{
            background:#007CC3;
        }
        table{
            background:#fff!important;
            
        }
        td{
                text-align: center;
        }
        th{
            text-align: center;
            background:#04334e!important;
        }
        .container{
            max-width:800px;
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
    </style>
</body>
</html>


