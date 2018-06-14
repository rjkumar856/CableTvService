<?php 
ob_start();
$reg_user = new USER(); 
if (!isset($_SESSION['userSession'])) {
 header('location:login');
}
include("header.php");

 
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
    }
  </style>
        <div class="site-content">
            <div class="content-area py-1">
                <div class="container-fluid">
                    <div class="row row-md mb-1">
                      
                        <div id="myChart"></div>
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
      title: {
        text: '<?php echo ucwords($name); ?> - Daily Report',
        fontColor: '#212121',
        fontFamily: 'Roboto',
        fontSize: 32,
        fontWeight: 'normal',
        textAlign: 'left',
        x: '10%',
        y: '9%',
        width: '60%',
      },
      options: {
        year: {
          text: '2017',
          visible: false
        },
        rows: 2,
        palette: ['none', '#3F51B5'],
        scale: {
          x: '75%',
          y: '15%',
          height: 10,
          width: '30%'
        },
        month: {
          item: {
            fontColor: 'gray',
            fontSize: 9
          },
          outline: {
            borderColor: '#BDBDBD',
            active: {
              borderColor: '#BDBDBD'
            }
          }
        },
        weekday: {
          values: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
          item: {
            fontColor: 'gray',
            fontSize: 9
          }
        },
        day: {
          inactive: {
            backgroundColor: '#F5F5F5'
          }
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
          ['<?php echo date("Y-m-d", $timestamp); ?>', <?php echo $allrows3; ?>, 
          '<?php
            $stmt2 = $reg_user->runQuery("SELECT * FROM tbl_daily_report WHERE (empName = '$name') AND (taskCreated like '$countdate%')");
            $stmt2->execute();
            $taskcre = "";
            for($i=0; $stmt3 = $stmt2->fetchObject(); $i++)
            {
                if($taskcre == ''){
                $taskcre.=$stmt3->taskModule;
                }else{$taskcre.=", ".$stmt3->taskModule;}
                 
            } 
            echo $taskcre;
          ?>'
          ,'<?php 
          $stmt4 = $reg_user->runQuery("SELECT * FROM tbl_daily_report WHERE (empName = '$name') AND (taskCreated like '$countdate%')");
            $stmt4->execute();
            $taskcre4 = "";
            for($i=0; $stmt5 = $stmt4->fetchObject(); $i++)
            {
                if($taskcre4 == ''){
                $taskcre4.=$stmt5->taskStatus;
                }else{$taskcre4.=", ".$stmt5->taskStatus;}
                 
            } 
            echo $taskcre4;
            ?>'],
          
     
<?php } ?>
        ]
      },
      plot: {
        tooltip: {
          text: '%data-day:<br><br>%data-info0<br><br>%data-info1.',
          alpha: 0.8,
          backgroundColor: '#212121',
          borderColor: '#212121',
          borderRadius: 3,
          fontColor: 'white',
          fontFamily: 'Georgia',
          fontSize: 12,
          offsetY: -10,
          textAlign: 'center',
          textAlpha: 1
        }
      },
      plotarea: {
        marginTop: '30%',
        marginBottom: '10%'
      }
    };

    zingchart.loadModules('calendar', function() {
      zingchart.render({
        id: 'myChart',
        data: myConfig,
        height: '100%',
        width: '100%'
      });
    });
  </script>
</body>

</html>