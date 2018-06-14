<?php 
ob_start();
$reg_user = new USER(); 
if (!isset($_SESSION['userSession'])) {
 header('location:login');
}
include("include/header.php");

 
?>
<link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="js/jquery.imgareaselect.js" type="text/javascript"></script>
<script src="js/jquery.form.js"></script>
<link rel="stylesheet" href="css/imgareaselect.css">
<script src="js/functions.js"></script>
  <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
  <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
  </script>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <style>
    html,
    body {
      height: 100%;
      width: 100%;
      margin: 0;
      padding: 0;
    }
    
    #myChart {
      height: 100%;
      width: 100%;
      min-height:700px;
    }
    
    .zc-ref {
      display: none;
    }.nav-tabs { border-bottom: 2px solid #DDD; }
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
    .nav-tabs > li > a { border: none; color: #ffffff;background: #5a4080; }
        .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none;  color: #5a4080 !important; background: #fff; }
        .nav-tabs > li > a::after { content: ""; background: #5a4080; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
    .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
.tab-nav > li > a::after { background: ##5a4080 none repeat scroll 0% 0%; color: #fff; }
.tab-pane { padding: 15px 0; }
.tab-content{padding:5px}
.nav-tabs > li  {width:20%; text-align:center;}
.card {background: #FFF none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); margin-bottom: 30px; }
@media all and (max-width:724px){
.nav-tabs > li > a > span {display:none;}	
.nav-tabs > li > a {padding: 5px 5px;}
}
.nav-tabs > li {
    width: 20%;
    text-align: center;
    padding: 6px;
    background: #5a4080;
}.nav-tabs > li > a {
    border: none;
    color: #ffffff;
    background: #5a4080;
    padding: 5px;
}.nav-tabs {
    border-bottom: 2px solid #DDD;
    display: -webkit-box;
}

  </style>
        <div class="site-content">
            <div class="content-area py-1">
                <div class="container-fluid">
                    <div class="row row-md mb-1">
                      <link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css" />
 
      <!-- Nav tabs -->
      <div class="card">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-user"></i> <span>Web Design</span></a></li>
          <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-user"></i> <span>SEO</span></a></li>
          <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-user"></i> <span>Designer</span></a></li>
          <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-user"></i> <span>Content Writer</span></a></li>
          <li role="presentation"><a href="#extra" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-user"></i> <span>APP</span></a></li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="home">
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#janani" aria-controls="janani" role="tab" data-toggle="tab"><i class="fa fa-user"></i> <span>Janani</span></a></li>
              <li role="presentation"><a href="#rajkumar" aria-controls="rajkumar" role="tab" data-toggle="tab"><i class="fa fa-user"></i> <span>Rajkumar</span></a></li>
              <li role="presentation"><a href="#prakash" aria-controls="prakash" role="tab" data-toggle="tab"><i class="fa fa-user"></i> <span>Prakash</span></a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="janani"><div id="myChart2"></div></div>
                <div role="tabpanel" class="tab-pane" id="rajkumar">rajkumar</div>
                <div role="tabpanel" class="tab-pane" id="prakash">prakash</div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="profile">SEO Team</div>
          <div role="tabpanel" class="tab-pane" id="messages">Designer</div>
          <div role="tabpanel" class="tab-pane" id="settings">Content Writer</div>
          <div role="tabpanel" class="tab-pane" id="extra">APP Team</div>
        </div>

                        
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-xs-center">
                        <div class="col-sm-4 text-sm-left mb-0-5 mb-sm-0">
                            2017 webliststore.in
                        </div>
                        <div class="col-sm-8 text-sm-right">
                            <ul class="nav nav-inline l-h-2">
                                <li class="nav-item"><a class="nav-link text-black" href="#">Privacy</a></li>
                                <li class="nav-item"><a class="nav-link text-black" href="#">Terms</a></li>
                                <li class="nav-item"><a class="nav-link text-black" href="#">Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- Vendor JS -->
        <script type="text/javascript" src="vendor/tether/js/tether.min.js"></script>
        <script type="text/javascript" src="vendor/bootstrap4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="vendor/detectmobilebrowser/detectmobilebrowser.js"></script>
        <script type="text/javascript" src="vendor/jscrollpane/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="vendor/jscrollpane/mwheelIntent.js"></script>
        <script type="text/javascript" src="vendor/jscrollpane/jquery.jscrollpane.min.js"></script>
        <script type="text/javascript" src="vendor/jquery-fullscreen-plugin/jquery.fullscreen-min.js"></script>
        <script type="text/javascript" src="vendor/waves/waves.min.js"></script>
        <script type="text/javascript" src="vendor/switchery/dist/switchery.min.js"></script>
        <script type="text/javascript" src="vendor/flot/jquery.flot.min.js"></script>
        <script type="text/javascript" src="vendor/flot/jquery.flot.resize.min.js"></script>
        <script type="text/javascript" src="vendor/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
        <script type="text/javascript" src="vendor/CurvedLines/curvedLines.js"></script>
        <script type="text/javascript" src="vendor/TinyColor/tinycolor.js"></script>
        <script type="text/javascript" src="vendor/sparkline/jquery.sparkline.min.js"></script>
        <script type="text/javascript" src="vendor/raphael/raphael.min.js"></script>
        <script type="text/javascript" src="vendor/morris/morris.min.js"></script>
        <script type="text/javascript" src="vendor/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
        <script type="text/javascript" src="vendor/jvectormap/jquery-jvectormap-world-mill.js"></script>
        <script type="text/javascript" src="vendor/peity/jquery.peity.js"></script>

        <!-- Neptune JS -->
        <script type="text/javascript" src="js/app.js"></script>
        <script type="text/javascript" src="js/demo.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        
 <script>
    var myConfig = {
      type: 'calendar',
      backgroundColor: '#fff',
      title: {
        text: '<?php echo ucwords($name); ?> - Report',
        fontFamily: 'Century Gothic',
        fontColor: '#00344d',
        fontSize: 34,
      },
      subtitle: {
        text: 'JUNE, JULY, AUGUST 2017',
        fontFamily: 'Century Gothic',
        fontColor: '#00344d',
        fontSize: 12,
        fontWeight: 'bold',
        y: '5%'
      },
      options: {
        year: {
          text: '2017',
          visible: false,
        },
        startMonth: 6, //November
        endMonth: 12, //November
        palette: ['none', 'red'],
        weekday: {
          values: ['Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'],
          item: {
            fontColor: '#00344d',
            fontFamily: 'Century Gothic',
            fontSize: 10
          }
        },
        month: {
          values: [null, null, null, null, null, null, null, null, null, null, null, null]
        },
        values: [
            <?php 
$stmt = $reg_user->runQuery("SELECT * FROM tbl_daily_report WHERE (empName = '$name') ORDER BY taskCreated ASC");
$stmt->execute();
for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
{
$db= $stmt1->taskCreated;
$timestamp = strtotime($db);
$countdate=date("Y-m-d", $timestamp);
$count3 = $reg_user->runQuery("SELECT count(*) as num_rows FROM tbl_daily_report WHERE (empName = '$name') AND (taskCreated like '$countdate%')");
$count3->execute();
$userRow3=$count3->fetch(PDO::FETCH_ASSOC);
$allrows3 = $userRow3['num_rows'];
?>
          ['<?php echo date("Y-m-d", $timestamp); ?>', <?php echo $allrows3; ?>, '<?php
            $stmt2 = $reg_user->runQuery("SELECT * FROM tbl_daily_report WHERE (empName = '$name') AND (taskCreated like '$countdate%')");
            $stmt2->execute();
            $taskcre = "";
            for($i=0; $stmt3 = $stmt2->fetchObject(); $i++)
            {
                if($taskcre == ''){
                $taskcre.=$stmt3->taskModule;
                }else{$taskcre.="; ".$stmt3->taskModule;}
                 
            } 
            echo htmlentities($taskcre);?>','<?php 
          $stmt4 = $reg_user->runQuery("SELECT * FROM tbl_daily_report WHERE (empName = '$name') AND (taskCreated like '$countdate%')");
            $stmt4->execute();
            $taskcre4 = "";
            for($i=0; $stmt5 = $stmt4->fetchObject(); $i++)
            {
                if($taskcre4 == ''){
                $taskcre4.=$stmt5->taskStatus;
                }else{$taskcre4.="; ".$stmt5->taskStatus;}
                 
            } 
            echo $taskcre4;
            ?>'],
          <?php } ?>
        ]
      },
      labels: [{
        text: 'Daily Report',

        backgroundColor: '#ffb9b9',
        borderColor: '#00344d',
        borderRadius: '5px',
        borderWidth: 1,
        fontColor: '#00344d',
        fontFamily: 'Century Gothic',
        fontSize: 16,
        fontWeight: 'bold',
        height: '20%',
        lineStyle: 'dotted',
        padding: '15%',
        verticalAlign: 'top',
        width: '95%',
        x: '2.5%',
        y: '10%'
      }, {
        backgroundColor: 'none',
        borderColor: 'red',
        borderRadius: '5px',
        borderWidth: 1,
        lineStyle: 'dotted',
        width: '87%',
        height: '12.5%',
        x: '6%',
        y: '15%',
      }, {
        text: '<b>NOTE:</b>Hover on the Date in Calender. The empty box shows they not update the report on that particular Date. Dark color represents they done more work',

        backgroundColor: '#ffb9b9',
        borderColor: '#00344d',
        borderRadius: '5px',
        borderWidth: 1,
        fontColor: '#00344d',
        fontFamily: 'Century Gothic',
        fontSize: 11,
        lineStyle: 'dotted',
        padding: '12%',
        verticalAlign: 'top',
        wrapText: true,

        width: '25%',
        height: '8%',
        x: '1%',
        y: '1%'
      }],
      plot: {
        tooltip: {
          text: 'Date: %data-day<br/>%v Report<br/> %data-info0,<br>%data-info1<br>',

          align: 'center',
          backgroundColor: 'none',
          borderColor: 'none',
          fontColor: '#00344d',
          wordwrap:'break-word',
          fontFamily: 'Century Gothic',
          fontSize: 13,
          height: '22%',
          padding: '0%',
          sticky: true,
          thousandsSeparator: ',',
          timeout: 30000,
          width: '90%',
          x: '5%',
          y: '10%'
        },
        valueBox: {
          fontColor: '#fff',
          fontFamily: 'Century Gothic',
          fontSize: 15,
          fontWeight: 'bold'
        }
      },
      plotarea: {
        marginBottom: '30%',
        marginLeft: '5%',
        marginRight: '5%',
        marginTop: '31%'
      }
    };

    zingchart.loadModules('calendar', function() {
      zingchart.render({
        id: 'myChart2',
        data: myConfig,
        height: 1000,
        width: 1200
      });
    });
  </script>
</body>

</html>