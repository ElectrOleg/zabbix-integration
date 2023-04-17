<?php

//$str = 'Inteface Fa1 (* Disabled *) is Administrative Down';
//echo preg_match("/Interface Fa1 \(.*?\) is Down/", $str);
//echo preg_match("/Fa1 \(.*\) is Down/", $str);

require_once __DIR__ . "/ZabbixApi.php";
require_once __DIR__ . "/libre_login.php";
use includes\libre\Login;



// $zabUrl ='https://zabbix.intranet/api_jsonrpc.php';
// $zabUser = 'user';
// $zabPassword = 'password';

$zabUrl ='https://zbx.intranet/api_jsonrpc.php';
$zabUser = 'user';
$zabPassword = 'password';

$sysmapId = 133;
// if(isset($_SERVER['argv'][1])){
//    if ($_SERVER['argv'][1] == 43) $sysmapId = 43;;
// }

//include '../../includes/libre_login.php';

// $userGroupID = 30;  // Proactive monitoring group for map permissions

$atm_on_icon = 200; //202;
$atm_off_icon = 201; //232;
$r_on_icon = 192; //198; Cisco_R_alarm(small)
$r_off_icon = 199; //191;
$cloud_off_icon = 3; 
///=============COORDINATES===========================
//Box 713 x 227 (240 - y step, 730 - x step, 750 - x step between providers)
//START FOR "CLIENT" (3 columns):
$x_client['sel0'] = 66;
$y_client['sel0'] = 235;
$x_client['sel1'] = 66;
$y_client['sel1'] = 115;
$x_client['sel2'] = 600;
$y_client['sel2'] = 180;
$x_client['sel3'] = 297;
$y_client['sel3'] = 191;
$x_client['sel2_1'] = 600;
$y_client['sel2_1'] = 115;
$x_client['sel2_2'] = 600;
$y_client['sel2_2'] = 235;
$x_client['sha0'] = 695;
$y_client['sha0'] = 238;
$x_client['sha1'] = 53;
$y_client['sha1'] = 76;
//START FOR "Sovintel" (3 columns):
$x_sovintel['sel0'] = 66 + (730*2) + 750;
$y_sovintel['sel0'] = 235;
$x_sovintel['sel1'] = 66 + (730*2) + 750;
$y_sovintel['sel1'] = 115;
$x_sovintel['sel2'] = 600 + (730*2) + 750;
$y_sovintel['sel2'] = 180;
$x_sovintel['sel3'] = 297 + (730*2) + 750;
$y_sovintel['sel3'] = 191;
$x_sovintel['sel2_1'] = 600 + (730*2) + 750;
$y_sovintel['sel2_1'] = 115;
$x_sovintel['sel2_2'] = 600 + (730*2) + 750;
$y_sovintel['sel2_2'] = 235;
$x_sovintel['sha0'] = 695 + (730*2) + 750;
$y_sovintel['sha0'] = 238;
$x_sovintel['sha1'] = 53 + (730*2) + 750;
$y_sovintel['sha1'] = 76;
//START FOR "MTS" (3 columns):
$x_mts['sel0'] = 66 + (730*2) + 750 + (730*2) + 750;
$y_mts['sel0'] = 235;
$x_mts['sel1'] = 66 + (730*2) + 750 + (730*2) + 750;
$y_mts['sel1'] = 115;
$x_mts['sel2'] = 600 + (730*2) + 750 + (730*2) + 750;
$y_mts['sel2'] = 180;
$x_mts['sel3'] = 297 + (730*2) + 750 + (730*2) + 750;
$y_mts['sel3'] = 191;
$x_mts['sel2_1'] = 600 + (730*2) + 750 + (730*2) + 750;
$y_mts['sel2_1'] = 115;
$x_mts['sel2_2'] = 600 + (730*2) + 750 + (730*2) + 750;
$y_mts['sel2_2'] = 235;
$x_mts['sha0'] = 695 + (730*2) + 750 + (730*2) + 750;
$y_mts['sha0'] = 238;
$x_mts['sha1'] = 53 + (730*2) + 750 + (730*2) + 750;
$y_mts['sha1'] = 76;
//START FOR "ROSTELECOM" (2 columns):
$x_rostelecom['sel0'] = 66 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750;
$y_rostelecom['sel0'] = 235;
$x_rostelecom['sel1'] = 66 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750;
$y_rostelecom['sel1'] = 115;
$x_rostelecom['sel2'] = 600 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750;
$y_rostelecom['sel2'] = 180;
$x_rostelecom['sel3'] = 297 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750;
$y_rostelecom['sel3'] = 191;
$x_rostelecom['sel2_1'] = 600 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750;
$y_rostelecom['sel2_1'] = 115;
$x_rostelecom['sel2_2'] = 600 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750;
$y_rostelecom['sel2_2'] = 235;
$x_rostelecom['sha0'] = 695 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750;
$y_rostelecom['sha0'] = 238;
$x_rostelecom['sha1'] = 53 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750;
$y_rostelecom['sha1'] = 76;
//START FOR "ORANGE" (2 columns):
$x_orange['sel0'] = 66 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750 + (730*1) + 750;
$y_orange['sel0'] = 235 ;
$x_orange['sel1'] = 66 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750 + (730*1) + 750;
$y_orange['sel1'] = 115;
$x_orange['sel2'] = 600 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750 + (730*1) + 750;
$y_orange['sel2'] = 180;
$x_orange['sel3'] = 297 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750 + (730*1) + 750;
$y_orange['sel3'] = 191;
$x_orange['sel2_1'] = 600 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750 + (730*1) + 750;
$y_orange['sel2_1'] = 115;
$x_orange['sel2_2'] = 600 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750 + (730*1) + 750;
$y_orange['sel2_2'] = 235;
$x_orange['sha0'] = 695 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750 + (730*1) + 750;
$y_orange['sha0'] = 238;
$x_orange['sha1'] = 53 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750 + (730*1) + 750;
$y_orange['sha1'] = 76;
//START FOR "Beeline" (2 columns):
$x_beeline['sel0'] = 66 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750 + (730*1) + 750 + (730*1) + 750;
$y_beeline['sel0'] = 235;
$x_beeline['sel1'] = 66 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750 + (730*1) + 750 + (730*1) + 750;
$y_beeline['sel1'] = 115;
$x_beeline['sel2'] = 600 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750 + (730*1) + 750 + (730*1) + 750;
$y_beeline['sel2'] = 180;
$x_beeline['sel3'] = 297 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750 + (730*1) + 750 + (730*1) + 750; 
$y_beeline['sel3'] = 191;
$x_beeline['sel2_1'] = 600 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750 + (730*1) + 750 + (730*1) + 750;
$y_beeline['sel2_1'] = 115;
$x_beeline['sel2_2'] = 600 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750 + (730*1) + 750 + (730*1) + 750;
$y_beeline['sel2_2'] = 235;
$x_beeline['sha0'] = 695 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750 + (730*1) + 750 + (730*1) + 750;
$y_beeline['sha0'] = 238;
$x_beeline['sha1'] = 53 + (730*2) + 750 + (730*2) + 750 + (730*2) + 750 + (730*1) + 750 + (730*1) + 750;
$y_beeline['sha1'] = 76;

//====================================
//=============counters for atm coordinates calculations=========
$count_client = 0;
$count_sovintel = 0;
$count_mts = 0;
$count_rostelecom = 0;
$count_orange = 0;
$count_beeline = 0;
//=============================================

$url= "https://nms.intranet/api/v0/devices";
$libre= new Login();
$arr=$libre->GetUrl($url);
for ($i=0;$i<count($arr['devices']);$i++){
    if (substr_count($arr['devices'][$i]['purpose'],'ATM')==0) continue;
    if (substr_count($arr['devices'][$i]['purpose'],'ATM_IP:')==0) continue;
    if (substr_count($arr['devices'][$i]['purpose'],'[DO]')==0) continue;
    // if ($sysmapId == 41){
    if (substr_count(strtoupper($arr['devices'][$i]['purpose']),'#MOSKVA')==0 &&
    substr_count(strtoupper($arr['devices'][$i]['purpose']),'#MO')==0 &&
    substr_count(strtoupper($arr['devices'][$i]['purpose']),'#МОСКВА')==0 &&
    substr_count(strtoupper($arr['devices'][$i]['purpose']),'#КАЛУГА')==0 &&
    substr_count(strtoupper($arr['devices'][$i]['purpose']),'#KALUGA')==0 &&
    substr_count(strtoupper($arr['devices'][$i]['purpose']),'#МО')==0
    ) continue;
    // }
    
    list(,$a)=explode("[ZBX_NAME:",$arr['devices'][$i]['purpose']);
    list($b,)=explode("]",$a);
    $atm[] = $b;

    if (substr_count($arr['devices'][$i]['purpose'],'ADDR:')>0){
        list(,$a)=explode("[ADDR:",$arr['devices'][$i]['purpose']);
        list($b,)=explode("]",$a);
        $atm[] =  $b;
    }
    else{ $atm[] ='';}

    if (substr_count($arr['devices'][$i]['purpose'],'ATM_IP:')==2){
        preg_match_all("/\[ATM_IP:(.*?)\]/",$arr['devices'][$i]['purpose'],$matches);
        if (substr_count($matches[1][0], '/') > 0){
            list($ip,) = explode('/',$matches[1][0]);
            $matches[1][0] = trim($ip);
        }
        if (substr_count($matches[1][1], '/') > 0){
            list($ip,) = explode('/',$matches[1][1]);
            $matches[1][1] = trim($ip);
        }
        $atm[] = ['ATM '.$matches[1][0], 'ATM '.$matches[1][1]];  
        //$atm[]=$matches;
    }
    else {
        preg_match("/\[ATM_IP:(.*?)\]/",$arr['devices'][$i]['purpose'],$matches);
        if (substr_count($matches[1], '/') > 0){
            list($ip,) = explode('/',$matches[1]);
            $matches[1] = trim($ip);
        }
        $atm[] = ['ATM '.$matches[1]];
    }
    
    $purp = strtoupper($arr['devices'][$i]['purpose']);
    if (substr_count($purp,'CLIENT')>0){
        $atm[17] = 'Client';
        $atm['color'] = 'FFBF00';
        $atm['x'] = $x_client;
        $atm['y'] = $y_client;
        $atm['purp'] = $purp;
        $count_client++;
        if ($count_client == 3){
            foreach ($x_client as $key => $val){
                $x_client[$key] = $val - (730*2);
            }
            foreach ($y_client as $key => $val){
                $y_client[$key] = $val + 240;
            }
            $count_client = 0;
        }
        else{
            foreach ($x_client as $key => $val){
                $x_client[$key] = $val + 730;
            }
        }

    }
    else if(substr_count($purp,'SOVINTEL')>0){
        $atm[17] = 'Sovintel';
        $atm['color'] = '64B5F6';
        $atm['x'] = $x_sovintel;
        $atm['y'] = $y_sovintel;
        $atm['purp'] = $purp;
        $count_sovintel++;
        if ($count_sovintel == 3){
            foreach ($x_sovintel as $key => $val){
                $x_sovintel[$key] = $val - (730*2);
            }
            foreach ($y_sovintel as $key => $val){
                $y_sovintel[$key] = $val +240;
            }
            $count_sovintel = 0;
        }
        else{
            foreach ($x_sovintel as $key => $val){
                $x_sovintel[$key] = $val + 730;
            }
        }
    }
    else if (substr_count($purp,'MTS')>0 || substr_count($purp,'COMSTAR')>0){
        $atm[17] = 'MTS/COMSTAR';
        $atm['color'] = 'FFCDD2';
        $atm['x'] = $x_mts;
        $atm['y'] = $y_mts;
        $atm['purp'] = $purp;
        $count_mts++;
        if ($count_mts == 3){
            foreach ($x_mts as $key => $val){
                $x_mts[$key] = $val - (730*2);
            }
            foreach ($y_mts as $key => $val){
                $y_mts[$key] = $val +240;
            }
            $count_mts = 0;
        }
        else{
            foreach ($x_mts as $key => $val){
                $x_mts[$key] = $val + 730;
            }
        }
    }
    else if(substr_count($purp,'ROSTELECOM')>0){
        $atm[17] = 'Rostelecom';
        $atm['color'] = 'CFD8DC';
        $atm['x'] = $x_rostelecom;
        $atm['y'] = $y_rostelecom;
        $atm['purp'] = $purp;
        $count_rostelecom++;
        if ($count_rostelecom == 2){
            foreach ($x_rostelecom as $key => $val){
                $x_rostelecom[$key] = $val - (730*1);
            }
            foreach ($y_rostelecom as $key => $val){
                $y_rostelecom[$key] = $val +240;
            }
            $count_rostelecom = 0;
        }
        else{
            foreach ($x_rostelecom as $key => $val){
                $x_rostelecom[$key] = $val + 730;
            }
        }
    }
    else if(substr_count($purp,'ORANGE')>0){
        $atm[17] = 'Orange';
        $atm['color'] = 'FF7043';
        $atm['x'] = $x_orange;
        $atm['y'] = $y_orange;
        $atm['purp'] = $purp;
        $count_orange++;
        if ($count_orange == 2){
            foreach ($x_orange as $key => $val){
                $x_orange[$key] = $val - (730*1);
            }
            foreach ($y_orange as $key => $val){
                $y_orange[$key] = $val +240;
            }
            $count_orange = 0;
        }
        else{
            foreach ($x_orange as $key => $val){
                $x_orange[$key] = $val + 730;
            }
        }
    }
    else if (substr_count($purp,'BEELINE')>0 && substr_count($purp,'GSM')>0){
        $atm[17] = 'Beeline_GSM';
        $atm['color'] = 'FFEE58';
        $atm['x'] = $x_beeline;
        $atm['y'] = $y_beeline;
        $atm['purp'] = $purp;
        $count_beeline++;
        if ($count_beeline == 2){
            foreach ($x_beeline as $key => $val){
                $x_beeline[$key] = $val - (730*1);
            }
            foreach ($y_beeline as $key => $val){
                $y_beeline[$key] = $val +240;
            }
            $count_beeline = 0;
        }
        else{
            foreach ($x_beeline as $key => $val){
                $x_beeline[$key] = $val + 730;
            }
        }
    }
    else{
        $atm[17] = '';
    }
   
    $atms[]=$atm;
    $hosts[] = $atm[0];
    //Client
    //Sovintel IP VPN
    //MTS / COMSTAR (Golden Line) IP VPN
    //Rostelecom
    //Orange Business Services
    //Beeline GSM
   
    $atm =[];
}
// var_dump($atms);
// exit;


$zbx = new ZabbixApi();
$zbx->login($zabUrl, $zabUser, $zabPassword);

$params = [
    'output' => [
        'host'
    ],
    'filter' => [
        'host' => $hosts
    ],
    'selectGraphs' => [
        'name'
    ],
    'selectTriggers' => [
        'description'
    ]
];

$result = $zbx->call('host.get', $params);
for ($i=0;$i<count($result);$i++){
    for ($j = 0;$j<count($atms);$j++){
        if ($result[$i]['host']==$atms[$j][0]){
            $atms[$j][3] = $result[$i]['hostid'];
            for ($k=0;$k<count($result[$i]['triggers']);$k++){
                if (count($atms[$j][2])==2){
                    if (substr_count($result[$i]['triggers'][$k]['description'],$atms[$j][2][0])>0){
                        $atms[$j][13][0]=$result[$i]['triggers'][$k]['triggerid'];
                    }
                    if (substr_count($result[$i]['triggers'][$k]['description'],$atms[$j][2][1])>0){
                        $atms[$j][13][1]=$result[$i]['triggers'][$k]['triggerid'];
                    }
                    if (preg_match("/Fa0 \(.*\) is Down/", $result[$i]['triggers'][$k]['description'])){
                        if (substr_count($result[$i]['triggers'][$k]['description'],'Disable')>0){
                            $atms[$j][14][0]='';
                        }
                        else{
                            $atms[$j][14][0]=$result[$i]['triggers'][$k]['triggerid'];
                        }  
                    }
                    if (preg_match("/Fa1 \(.*\) is Down/", $result[$i]['triggers'][$k]['description'])){
                        if (substr_count($result[$i]['triggers'][$k]['description'],'Disable')>0){
                            $atms[$j][14][1]='';
                        }
                        else{
                            $atms[$j][14][1]=$result[$i]['triggers'][$k]['triggerid'];
                            $atms[$j][15][1]='T015.phycommon.ifHCInOctets[Fa1]';
                            $atms[$j][16][1]='T015.phycommon.ifHCOutOctets[Fa1]';
                        }  
                    }
                }
                else{
                    if (substr_count($result[$i]['triggers'][$k]['description'],$atms[$j][2][0])>0){
                        $atms[$j][13][0]=$result[$i]['triggers'][$k]['triggerid'];
                    }
                    if (preg_match("/Fa0 \(.*\) is Down/", $result[$i]['triggers'][$k]['description'])){
                        if (substr_count($result[$i]['triggers'][$k]['description'],'Disable')>0){
                            $atms[$j][14][0]='';
                        }
                        else{
                            $atms[$j][14][0]=$result[$i]['triggers'][$k]['triggerid'];
                            $atms[$j][15][0]='T015.phycommon.ifHCInOctets[Fa0]';
                            $atms[$j][16][0]='T015.phycommon.ifHCOutOctets[Fa0]';
                        }  
                    }
                }
                if (substr_count($result[$i]['triggers'][$k]['description'],'Inteface Tu1 (* HUB-1 *) is Down')>0){
                    $atms[$j][5]=$result[$i]['triggers'][$k]['triggerid'];
                    $atms[$j][7]='T015.tunnels.ifHCInOctets[Tu1]';
                    $atms[$j][8]='T015.tunnels.ifHCOutOctets[Tu1]';
                }
                if (substr_count($result[$i]['triggers'][$k]['description'],'Inteface Tu2 (* HUB-2 *) is Down')>0){
                    $atms[$j][9]=$result[$i]['triggers'][$k]['triggerid'];
                    $atms[$j][11]='T015.tunnels.ifHCInOctets[Tu2]';
                    $atms[$j][12]='T015.tunnels.ifHCOutOctets[Tu2]';
                }
            }
            for ($q=0;$q<count($result[$i]['graphs']);$q++){
                if (substr_count($result[$i]['graphs'][$q]['name'],'ICMP ping availability')>0){
                    $atms[$j][4] = $result[$i]['graphs'][$q]['graphid'];
                }
                if (substr_count($result[$i]['graphs'][$q]['name'],'TUNNEL Inteface Tu1 (* HUB-1 *) Utilization')>0){
                    $atms[$j][6] = $result[$i]['graphs'][$q]['graphid'];
                }
                if (substr_count($result[$i]['graphs'][$q]['name'],'TUNNEL Inteface Tu2 (* HUB-2 *) Utilization')>0){
                    $atms[$j][10] = $result[$i]['graphs'][$q]['graphid'];
                }
            }
            if (count($atms[$j][2])==2 && $atms[$j][14][1]==''){
                $atms[$j][14][1] = $atms[$j][13][1];              
            }
            if ($atms[$j][14][0] == ''){
                $atms[$j][14][0] = $atms[$j][13][0];
            }

        }
    }
}

/*
foreach ($y as $key => $val){
    $y[$key] += 240;
}*/
// var_dump($atms);
// exit;

$expl = array('br-atm0350',271107,271108,104359,'ICMP ping to 172.29.0.202',271127,11956,'Москва, Дербеневская наб., 7 стр 22, Ренессанс, внутреннее (служебное) помещение');
$expl2 = [
    'br-bna1012', //name from NMS (obj_router) 0
    'МО, Красногорск, улица Ленина, 2, 1-й этаж, ТЦ "Красный кит"', //address from NMS 1
    ['ATM 172.29.32.122'], //Array with ATMs labels 2
    12343, //hostid from Zabbix (obj_router) 3
    66301, //graphid for ICMP (obj_router) 4
    303399, //triggerid for Tu1 (obj_cloud_1) 5
    64864, //graphid for Tu1 utilization (obj_cloud_1) 6
    'T015.tunnels.ifHCInOctets[Tu1]', //key for Tu1 input link 7
    'T015.tunnels.ifHCOutOctets[Tu1]', //key for Tu1 output link 8
    303400, //triggerid for Tu2 (obj_cloud_2) 9
    64865, //graphid for Tu2 utilization (obj_cloud_2) 10
    'T015.tunnels.ifHCInOctets[Tu2]', //key for Tu2 input link 11
    'T015.tunnels.ifHCOutOctets[Tu2]', //key for Tu2 output link 12
    [326724], //triggerid for ICMP to ATM (obj_atm_1) 13
    [303386], //triggerid for Fa0 link (obj_atm_1) 14
    ['T015.phycommon.ifHCInOctets[Fa0]'], //key for Fa0 input link 15
    ['T015.phycommon.ifHCOutOctets[Fa0]'], //key for Fa0 output link 16
];
//Params needed
//https://zabbix.intranet/charts.php?page=1&groupid=17&hostid=12343&graphid=64864&action=showgraph
//1) hostid

/*
$params = array(
    //	'name'                  =>'Api_test_map',
    //	'width'                 =>'1000',
    //	'height'                =>'1000'
        "sysmapids"             => "44",
    //	"sysmapids"             => "36",
    //	"output"                => "extend",
        "selectSelements"       => "extend",
        "selectLinks"           => "extend",
    //	"selectUsers"           => "extend",
    //	"selectUserGroups"      => "extend",
        "selectShapes"          => "extend"
    //	"selectLines"           => "extend",
    );
    
$result = $zbx->call('map.get',$params);
$sel = $result[0]['selements'];
$sha = $result[0]['shapes'];
$lin = $result[0]['links'];
*/
$sel = [];
$sha = [];
$lin = [];

$big_shape_names[] = 'Client internet channel';
$big_shape_names[] = 'Sovintel IP VPN';
$big_shape_names[] = 'MTS / COMSTAR (Golden Line) IP VPN';
$big_shape_names[] = 'Rostelecom';
$big_shape_names[] = 'Orange Business Services';
$big_shape_names[] = 'Beeline GSM';

$big_shape_color[] = 'FFECB3';
$big_shape_color[] = '4000FF';
$big_shape_color[] = 'E57373';
$big_shape_color[] = 'ECEFF1';
$big_shape_color[] = 'FB8C00';
$big_shape_color[] = 'FFEB3B';

$big_shape_x[] = 45;
$big_shape_x[] = 2255;
$big_shape_x[] = 4465;
$big_shape_x[] = 6675;
$big_shape_x[] = 8155;
$big_shape_x[] = 9635;

for ($i=0;$i<6;$i++){
    if ($i < 3) $wid = 2189;
    else $wid = 1459;
    $big_shape = [
        "type"                 	=>"0",
	    "x"                    	=>$big_shape_x[$i],
	    "y"                    	=>1,
	    "width"                	=>$wid,
	    "height"               	=>6000,
	    "text"			        =>$big_shape_names[$i],
	    "font"                 	=>"9",
	    "font_size"            	=>"36",
	    "font_color"           	=>$big_shape_color[$i],
	    "text_halign"          	=>"0",
	    "text_valign"          	=>"1",
	    "border_type"          	=>"2",
	    "border_width"         	=>"4",
	    "border_color"         	=>$big_shape_color[$i],
        "background_color"      =>""
    ];
    array_push($sha,$big_shape);

}

//var_dump($result);
//exit;

//name[0],tu1-linkDown[1],tu2-linkDown[2],icmp ping to[3], icmp name[4], Fa-linkDown[5],hostID[6],addr[7]
//echo substr($expl[4],13);
//exit;
$selementid['sel0'] = 1;
$selementid['sel1'] = 2;
$selementid['sel2'] = 3;
$selementid['sel3'] = 4;
$selementid['sel2_1'] = 5;
$selementid['sel2_2'] = 6;
$selementid['lin0.1'] = 4;
$selementid['lin0.2'] = 3;
$selementid['lin0_1.1'] = 4;
$selementid['lin0_1.2'] = 5;
$selementid['lin0_2.1'] = 4;
$selementid['lin0_2.2'] = 6;
$selementid['lin1.1'] = 4;
$selementid['lin1.2'] = 1;
$selementid['lin2.1'] = 4;
$selementid['lin2.2'] = 2;

for ($i=0;$i<count($atms);$i++){

    // if ($atms[$i][17] == '') continue;

    if (!isset($atms[$i][13])) {
        echo $atms[$i][0]."\n";
        continue;
    }

    /*
    if (!isset($atms[$i][4])) {
        echo $atms[$i][0]."\n";
       continue;
    }

    if (!isset($atms[$i][3])) {
      echo $atms[$i][0]."\n";
       continue;
    }
    */

    //if (!isset($atms[$i][10])) {echo $atms[$i]['purp']; exit;}
    if (isset($atms[$i][9])){
        $selement0 = array(
            "selementid"		=>$selementid['sel0'],
            "sysmapid"		=>$sysmapId,
            "elementtype"		=>"2",
            "iconid_off"		=>$cloud_off_icon,
            "iconid_on"		=>"0",
            "label"			=>"Tu2 (* HUB-2 *)",
            "x"			=>$atms[$i]['x']['sel0'], //have to be culculated
            "y"			=>$atms[$i]['y']['sel0'], //have to be culculated
            "elements"		=>array(array("triggerid" => $atms[$i][9])), //array value used from device
            "urls" => array(
                        array(
                            "name" => "Tu2 Utilization graph",
                            // "url" => "https://zabbix.intranet/charts.php?page=1&groupid=17&hostid=".$atms[$i][3]."&graphid=".$atms[$i][10]."&action=showgraph"
                            "url" => "https://zbx.intranet/zabbix.php?action=charts.view&filter_set=1&filter_hostids%5B0%5D=".$atms[$i][3]
                            )
                        )
        );
        
        $link1 =array(
            "sysmapid"		=>$sysmapId,
            "selementid1"		=>$selementid['lin1.1'],
            "selementid2"		=>$selementid['lin1.2'],
            "drawtype"		=>"0",
            "color"			=>"00CC00",
            // "label"			=>"Tu2 input : {".$atms[$i][0].":T015.tunnels.ifHCInOctets[Tu2].last()}
            "label"			=>"Tu2 input : {?last(/".$atms[$i][0]."/net.if.in[ifHCinOctets.Tu2])}
            Tu2 output [NEG] : {?last(/".$atms[$i][0]."/net.if.out[ifHCOutOctets.Tu2])}",
            // "label"			=>"Tu2",
            // Tu2 output [NEG] : {".$atms[$i][0].":T015.tunnels.ifHCOutOctets[Tu2].last()}",
            "linktriggers"		=>array(array("triggerid" => $atms[$i][9],"drawtype" => "0","color" => "DD0000"))
        );
        array_push($sel,$selement0);
        array_push($lin,$link1);
        // net.if.in[ifHCinOctets.Tu1]
        // net.if.out[ifHCOutOctets.Tu1]
    }
    if (isset($atms[$i][5])){
        $selement1 = array(
            "selementid"		=>$selementid['sel1'],
            "sysmapid"		=>$sysmapId,
            "elementtype"		=>"2",
            "iconid_off"		=>$cloud_off_icon,
            "iconid_on"		=>"0",
            "label"			=>"Tu1 (* HUB-1 *)",
            "x"			=>$atms[$i]['x']['sel1'], //have to be culculated
            "y"			=>$atms[$i]['y']['sel1'], //have to be culculated +240
            "elements"		=>array(array("triggerid" => $atms[$i][5])), //array value used from device
            "urls" => array(
                        array(
                            "name" => "Tu1 Utilization graph",
                            // "url" => "https://zabbix.intranet/charts.php?page=1&groupid=17&hostid=".$atms[$i][3]."&graphid=".$atms[$i][6]."&action=showgraph"
                            "url" => "https://zbx.intranet/zabbix.php?action=charts.view&filter_set=1&filter_hostids%5B0%5D=".$atms[$i][3]
                            )
                        )
        );
        $link2 =array(
            "sysmapid"		=>$sysmapId,
            "selementid1"		=>$selementid['lin2.1'],
            "selementid2"		=>$selementid['lin2.2'],
            "drawtype"		=>"0",
            "color"			=>"00CC00",
            // "label"			=>"Tu1",
            "label"			=>"Tu1 input : {?last(/".$atms[$i][0]."/net.if.in[ifHCinOctets.Tu1])}
            Tu1 output [NEG] : {?last(/".$atms[$i][0]."/net.if.out[ifHCOutOctets.Tu1])}",
            // "label"			=>"Tu1 input : {".$atms[$i][0].":T015.tunnels.ifHCInOctets[Tu1].last()}
            // Tu1 output [NEG] : {".$atms[$i][0].":T015.tunnels.ifHCOutOctets[Tu1].last()}",
            "linktriggers"		=>array(array("triggerid" => $atms[$i][5],"drawtype" => "0","color" => "DD0000"))
        );
        array_push($sel,$selement1);
        array_push($lin,$link2);
    }
    if (isset($atms[$i][2][0])){
        if (count($atms[$i][2])==2){
            $selement2_1 = array(
                "selementid"		=>$selementid['sel2_1'],
                "sysmapid"		=>$sysmapId,
                "elementtype"		=>"2",
                "iconid_off"		=>$atm_off_icon,
                "iconid_on"		=>$atm_on_icon,
                "label"			=>$atms[$i][2][0],
                "x"			=>$atms[$i]['x']['sel2_1'], //have to be culculated
                "y"			=>$atms[$i]['y']['sel2_1'], //have to be culculated +240
                "elements"		=>array(array("triggerid" => $atms[$i][13][0])) //array value used from device
            );
            $selement2_2 = array(
                "selementid"		=>$selementid['sel2_2'],
                "sysmapid"		=>$sysmapId,
                "elementtype"		=>"2",
                "iconid_off"		=>$atm_off_icon,
                "iconid_on"		=>$atm_on_icon,
                "label"			=>$atms[$i][2][1],
                "x"			=>$atms[$i]['x']['sel2_2'], //have to be culculated
                "y"			=>$atms[$i]['y']['sel2_2'], //have to be culculated +240
                "elements"		=>array(array("triggerid" => $atms[$i][13][1])) //array value used from device
            );
            $link0_1 = array(
                "sysmapid"		=>$sysmapId,
                "selementid1"		=>$selementid['lin0_1.1'],
                "selementid2"		=>$selementid['lin0_1.2'],
                "drawtype"		=>"0",
                "color"			=>"00CC00",
                // "label"			=>"Fa0 input : {".$atms[$i][0].":T015.phycommon.ifHCInOctets[Fa0].last()}
                // Fa0 output [NEG] : {".$atms[$i][0].":T015.phycommon.ifHCOutOctets[Fa0].last()}",
                "label"			=>"Fa0 input : {?last(/".$atms[$i][0]."/net.if.in.eth[ifHCinOctets.Fa0])}
                Fa0 output [NEG] : {?last(/".$atms[$i][0]."/net.if.out.eth[ifHCOutOctets.Fa0])}",
                // "label"			=>"Fa0",
                "linktriggers"		=>array(array("triggerid" => $atms[$i][14][0],"drawtype" => "0","color" => "DD0000"))
            );
            $link0_2 = array(
                "sysmapid"		=>$sysmapId,
                "selementid1"		=>$selementid['lin0_2.1'],
                "selementid2"		=>$selementid['lin0_2.2'],
                "drawtype"		=>"0",
                "color"			=>"00CC00",
                "label"			=>"Fa1 input : {?last(/".$atms[$i][0]."/net.if.in.eth[ifHCinOctets.Fa1])}
                Fa1 output [NEG] : {?last(/".$atms[$i][0]."/net.if.out.eth[ifHCOutOctets.Fa1])}",
                // "label"			=>"Fa1 input : {".$atms[$i][0].":T015.phycommon.ifHCInOctets[Fa1].last()}
                // Fa1 output [NEG] : {".$atms[$i][0].":T015.phycommon.ifHCOutOctets[Fa1].last()}",
                // "label"			=>"Fa1",
                "linktriggers"		=>array(array("triggerid" => $atms[$i][14][1],"drawtype" => "0","color" => "DD0000"))
            );
            if (!isset($atms[$i][15][0])) $link0_1['label'] = '';
            if (!isset($atms[$i][15][1])) $link0_2['label'] = '';
            array_push($sel,$selement2_1);
            array_push($sel,$selement2_2);
            array_push($lin,$link0_1);
            array_push($lin,$link0_2);
        
        
        }
        else{
            $selement2 = array(
                "selementid"		=>$selementid['sel2'],
                "sysmapid"		=>$sysmapId,
                "elementtype"		=>"2",
                "iconid_off"		=>$atm_off_icon,
                "iconid_on"		=>$atm_on_icon,
                "label"			=>$atms[$i][2][0],
                "x"			=>$atms[$i]['x']['sel2'], //have to be culculated
                "y"			=>$atms[$i]['y']['sel2'], //have to be culculated +240
                "elements"		=>array(array("triggerid" => $atms[$i][13][0])) //array value used from device
            );
            $link0 = array(
                "sysmapid"		=>$sysmapId,
                "selementid1"		=>$selementid['lin0.1'],
                "selementid2"		=>$selementid['lin0.2'],
                "drawtype"		=>"0",
                "color"			=>"00CC00",
                // "label"			=>"Fa0",
                // "label"			=>"Fa0 input : {".$atms[$i][0].":T015.phycommon.ifHCInOctets[Fa0].last()}
                // Fa0 output [NEG] : {".$atms[$i][0].":T015.phycommon.ifHCOutOctets[Fa0].last()}",
                "label"			=>"Fa0 input : {?last(/".$atms[$i][0]."/net.if.in.eth[ifHCinOctets.Fa0])}
                Fa0 output [NEG] : {?last(/".$atms[$i][0]."/net.if.out.eth[ifHCOutOctets.Fa0])}",
                "linktriggers"		=>array(array("triggerid" => $atms[$i][14][0],"drawtype" => "0","color" => "DD0000"))
            );
            if (!isset($atms[$i][15][0])) $link0['label'] = '';
            array_push($sel,$selement2);
            array_push($lin,$link0);
        }    
    }
    
    $selement3 = array(
        "selementid"		=>$selementid['sel3'],
        "sysmapid"		=>$sysmapId,
        "elementtype"		=>"0",
        "iconid_off"		=>$r_off_icon,
        "iconid_on"		=>$r_on_icon,
        "label"			=>$atms[$i][0],
        "x"			=>$atms[$i]['x']['sel3'], //have to be culculated
        "y"			=>$atms[$i]['y']['sel3'], //have to be culculated +240
        "elements"		=>array(array("hostid" => $atms[$i][3])), //array value used from device ICMP availability graph
        "urls" => array(
                    array(
                        "name" => "ICMP availability graph",
                        // "url" => "https://zabbix.intranet/charts.php?page=1&groupid=17&hostid=".$atms[$i][3]."&graphid=".$atms[$i][4]."&action=showgraph"
                        "url" => "https://zbx.intranet/zabbix.php?action=charts.view&filter_set=1&filter_hostids%5B0%5D=".$atms[$i][3]
                        )
                    )
    );
    if (!isset($atms[$i][4])) $selement3['urls'] = '';
    $shape0 = array(
        "type"                 	=>"0",
        "x"                    	=>$atms[$i]['x']['sha0'],
        "y"                    	=>$atms[$i]['y']['sha0'],
        "width"                	=>"70",
        "height"               	=>"64",
        "text"			        =>substr($atms[$i][0],6),
        "font"                 	=>"9",
        "font_size"            	=>"30",
        "font_color"           	=>$atms[$i]['color'],
        "text_halign"          	=>"0",
        "text_valign"          	=>"0",
        "border_type"          	=>"1",
        "border_width"         	=>"2",
        "border_color"         	=>$atms[$i]['color'],
        "background_color"      =>"000000"
    );
    if (count($atms[$i][2])==2){
        if(substr_count(substr($atms[$i][0],6),'_atm')>0) $shape0['text'] = str_replace('_atm', ' ', substr($atms[$i][0],6));
        else if(substr_count(substr($atms[$i][0],6),'-atm')>0) $shape0['text'] = str_replace('-atm', ' ', substr($atms[$i][0],6));
        else if (substr_count(substr($atms[$i][0],6),'_bna')>0) $shape0['text'] = str_replace('_bna', ' ', substr($atms[$i][0],6));
        else if (substr_count(substr($atms[$i][0],6),'-bna')>0) $shape0['text'] = str_replace('-bna', ' ', substr($atms[$i][0],6));
        else $shape0['text'] = str_replace('_', ' ', substr($atms[$i][0],6));
    }
    $shape1 = array(
        "type"                 	=>"0",
        "x"                    	=>$atms[$i]['x']['sha1'],
        "y"                    	=>$atms[$i]['y']['sha1'],
        "width"                	=>"713",
        "height"               	=>"227",
        "text"			        =>$atms[$i][1],
        "font"                 	=>"9",
        "font_size"            	=>"16",
        "font_color"           	=>$atms[$i]['color'],
        "text_halign"          	=>"1",
        "text_valign"          	=>"1",
        "border_type"          	=>"1",
        "border_width"         	=>"3",
        "border_color"         	=>$atms[$i]['color']
    );
    
    array_push($sel,$selement3);
    array_push($sha,$shape0);
    array_push($sha,$shape1);
    
    
    foreach ($selementid as $key => $val){
        $selementid[$key] += 6;
    }
}
/*
$params = array(
	"sysmapid"             	=>"44",
	"shapes"               	=>array(),
	"selements"		        =>array(),
	"links"			        =>array()
);

$result = $zbx->call('map.update',$params);
//exit;
*/
$params = array(
	"sysmapid"             	=>$sysmapId,
	"shapes"               	=>$sha,
	"selements"		        =>$sel,
	"links"			        =>$lin,
    "severity_min"          => 2
    // "userGroups"            => [["usrgrpid" => $userGroupID, "permission" => 2]]
);
// var_dump($params);
// exit;

//in {r-mow-ost5-1:net.if.intu[ifHCinOctets.Tu88].avg(300)}
//in {?avg(/r-mow-ost5-1/net.if.intu[ifHCinOctets.Tu88],300s)}
$result = $zbx->call('map.update',$params);

