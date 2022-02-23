<?php
    
    $ticket=$track=$tracklist=$json_track=$tracklist_list="";
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
    // var_dump($ticket);
    // var_dump($_POST['sender']);
    $domainarray=[];
    $domains= curl_init();

    curl_setopt($domains, CURLOPT_URL, "https://mx-01.accessworld.net:8006/api2/json/config/transport");
    curl_setopt($domains, CURLOPT_HTTPHEADER, array("Cookie: PMGAuthCookie=$ticket"));
    curl_setopt($domains, CURLOPT_RETURNTRANSFER, 1);
    $domainslist = curl_exec($domains);
    curl_close($domains);
    $json_track= json_decode($domainslist,true);
    $domainslist_list= $json_track['data'];
    // var_dump($domainslist_list);
    foreach($domainslist_list as $domainlist){
         array_push($domainarray,$domainlist['domain']);
    }

    if(isset($_POST["receiver"]) && isset($_POST['sender']))
    {
        // var_dump($_POST['receiver']);
        $track= curl_init();

        $sender=$receiver=$starttime=$endtime="";
        $receiver=$_POST['receiver'];
        date_default_timezone_set('Asia/Kathmandu');
        $sender=$_POST['sender']==""?"@":$_POST['sender'];
        $endtime=$_POST['endtime']==""?strtotime(date('r')):strtotime($_POST['endtime']);
        $starttime=$_POST['starttime']==""?strtotime(date('r',strtotime("-1 days"))):strtotime($_POST['starttime']);

        //  var_dump($_POST['sender']);
        // var_dump($starttime);
        curl_setopt($track, CURLOPT_URL, "https://mx-01.accessworld.net:8006/api2/json/nodes/mx-01/tracker?target=".$receiver."&from=".$sender."&starttime=".$starttime."&endtime="."$endtime"."&greylist=1");
        // curl_setopt($track, CURLOPT_URL, "https://mx-01.accessworld.net:8006/api2/json/nodes/mx-01/tracker?target=".$receiver."&from=".$sender."&starttime=".$starttime."&endtime="."$endtime"."&greylist=1");
        curl_setopt($track, CURLOPT_HTTPHEADER, array("Cookie: PMGAuthCookie=$ticket"));
        curl_setopt($track, CURLOPT_RETURNTRANSFER, 1);
        $tracklist = curl_exec($track);

        // var_dump(substr_replace($blacklist, "",-1));
        curl_close($track);
        
        $json_track= json_decode($tracklist,true);
        $tracklist_list= $json_track['data'];
    

                     

    }


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessworld Email Gateway Blacklist</title>
    <link rel="stylesheet" href="./assets/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/6.0.0-beta2/css/tempus-dominus.css"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="./assets/js/bootstrap-datetimepicker.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/6.0.0-beta2/js/tempus-dominus.js"></script> -->
    <script src="https://kit.fontawesome.com/4cbb517f98.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <img class="img-fluid top-logo" src="https://email.accessworld.net/skins/_base/logos/LoginBanner_white.png?v=210621064452" alt="">
        <h3 class="header-title">Mail Tracking Center</h3>
    </header>
    <div class="container">
    <form action="tracking.php" method="POST">
                <div class="form-group">
                    <label for="sender">Sender Email/Domain</label>
                    <input type="text" class="form-control" name="sender" id="sender" placeholder="Sender Email/Domain">
                </div>
                <div class="form-group">
                    <label for="receiver">Receiver Email/Domain</label>
                    <select class="form-control" name="receiver"  id="receiver">
                        <!-- <option value="nac.com.np">nac.com.np</option>
                        <option value="accessworld.net">accessworld.net</option>
                        <option value="leadsinnovation.com">leadsinnovation.com</option>
                        <option value="relifeinsurance.com">relifeinsurance.com</option>
                        <option value="prabhulife.com">prabhulife.com</option> -->
                        <?php 
                            foreach($domainarray as $domain){
                                echo "<option value='$domain'>$domain</option>";
                            }

                        
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="datetimepicker1">End Time</label>
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" name="endtime" />
                        <span class="input-group-addon">
                        <!-- <span class="glyphicon glyphicon-calendar"> -->
                            <i class="fa-solid fa-calendar-days"></i>
                        <!-- </span> -->
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="datetimepicker2">Start Time</label>
                    <div class='input-group date' id='datetimepicker2'>
                        <input type='text' class="form-control" name="starttime" />
                        <span class="input-group-addon">
                        <!-- <span class="glyphicon glyphicon-calendar"> -->
                            <i class="fa-solid fa-calendar-days"></i>
                        <!-- </span> -->
                        </span>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function () {
                        $('#datetimepicker1').datetimepicker({
                            useCurrent: false //Important! See issue #1075
                        });
                        $('#datetimepicker2').datetimepicker({
                            useCurrent: false //Important! See issue #1075
                        });
                        $("#datetimepicker1").on("dp.change", function (e) {
                            $('#datetimepicker1').data("DateTimePicker").minDate(e.date);
                        });
                        $("#datetimepicker1").on("dp.change", function (e) {
                            $('#datetimepicker2').data("DateTimePicker").maxDate(e.date);
                        });
                    });
                </script>   
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        <?php if(isset($_POST["receiver"]) && isset($_POST['sender'])){ ?>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Time</th>
                        <th scope="col">Sender Address</th>
                        <th scope="col">Receiver Address</th>
                        <th scope="col">Delivery Status</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        

                            foreach (array_reverse($tracklist_list) as $tracking){
                                                                
                                    if($tracking['dstatus']=="A"){
                                        echo "<tr><td style='max-width:100px'>".date('Y-m-d H:i:s',$tracking['time'])."</td><td>".$tracking['from']."</td><td>".$tracking['to']."</td><td style='max-width:100px;font-weight:bolder;color:green'>Accepted</td></tr>";
                                    }elseif($tracking['dstatus']=="B"){
                                        echo "<tr style='background:#f34444 !important;color:white!important;'><td style='max-width:100px'>".date('Y-m-d H:i:s',$tracking['time'])."</td><td>".$tracking['from']."</td><td>".$tracking['to']."</td><td style='max-width:100px;font-weight:bolder;'>Blocked</td></tr>";
                                    }elseif($tracking['dstatus']=="Q"){
                                        echo "<tr style='background:#FFE7C2!important;color:black!important;'><td style='max-width:100px'>".date('Y-m-d H:i:s',$tracking['time'])."</td><td>".$tracking['from']."</td><td>".$tracking['to']."</td><td style='max-width:100px;font-weight:bolder;'>Quarantined</td></tr>";
                                    }elseif($tracking['dstatus']=="N"){
                                        echo "<tr style='background:#646363!important;color:white!important;'><td style='max-width:100px'>".date('Y-m-d H:i:s',$tracking['time'])."</td><td>".$tracking['from']."</td><td>".$tracking['to']."</td><td style='max-width:100px;font-weight:bolder;'>Rejected </td></tr>";
                                    }elseif($tracking['dstatus']=="G"){
                                        echo "<tr style='background:#9d9d9d!important;color:white!important;'><td style='max-width:100px'>".date('Y-m-d H:i:s',$tracking['time'])."</td><td>".$tracking['from']."</td><td>".$tracking['to']."</td><td style='max-width:100px;font-weight:bolder;'>Greylisted </td></tr>";
                                    }
                                
                            }
                
                        


                    ?>
                </tbody>
            </table>
        <?php }else{?>
            
        <?php }?>
    </div>
    <style>
        body{
            background:#007CC3;
        }
        table{
            background:#fff!important;
            
        }
        .table.table-striped td{
            text-align: left;
            max-width:250px;
            inline-size:250px;
            overflow-wrap: break-word;
            font-size:12px;
            padding:5px 10px!important;
        }
        .table.table-striped th{
            text-align: center;
            background:#04334e!important;
        }
        .container{
            min-width:800px;
        }
        form{
            padding:2rem;
            background: #ffffff;


        }
        header{
            min-height:50px;
        }
        .top-logo{
            display: block;
            text-align:center;
            margin:0 auto;
            margin-left:0
            /* zoom:1.2; */
        }
        .header-title{
            color:#fff;
            text-align:center;
            margin-bottom: 20px;
            margin-top:10px;
        }
        .fa-solid.fa-calendar-days{
            line-height: 34px;
            padding: 5px 10px;
        }
        .input-group-addon{
            background:#007cc340;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;

        }
    </style>
</body>
</html>


