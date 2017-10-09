<html>
<head>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include("connect.php"); ?>
    <div id="wrapper" class="toggled">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav" id="MainMenu">
                <li class="sidebar-brand">
                    <a href="#">
                        Choices
                    </a>
                </li>
                <li class="markwise">
                    <a href="#">Markwise</a>
                    <ul class="type">
                        <?php 
                            $sql="select * from data;";
                            $result=mysqli_query($con,$sql);
                            while($row=mysqli_fetch_assoc($result)){
                                echo '<li name="'.$row["Fields"].'"><a href="#">'.$row["Fields"].'</a></li>';
                            }
                        ?>
                    </ul>
                </li>
                <li class="fieldwise">
                    <a href="#">Fieldwise</a>
                    <ul class="type">
                        <li name="Physics"><a href="#">Physics</a></li>
                        <li name="Maths"><a href="#">Maths</a></li>
                        <li name="Chemistry"><a href="#">Chemistry</a></li>
                        <li name="Bio"><a href="#">Bio</a></li>
                        <li name="SST"><a href="#">SST</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div id="barchart_values" style="width: 900px; height: 300px;"></div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#MainMenu').find('> li').click(function() {
                $('#MainMenu > li').not(this).find('ul').slideUp();
                $(this).find('ul').stop(true, true).slideToggle(400);
                return false;
            });
            $('.type li').click(function() {
                var t = $(this).parent().parent().attr("class");
                var d = $(this).attr('name');
                $.ajax({
                    url: 'fetch.php',
                    data: {
                        "data": d,
                        "type": t
                    },
                    type: 'post',
                    success: function(resp) {
                        var temp = resp.split(".");
                        temp.splice(temp.length-1,1);
                        var plot = new Array();
                        var temp2 = new Array();
                        temp2.push("Subject");
                        temp2.push("score");
                        temp2.push({ role: "style" });
                        plot.push(temp2);
                        for(var i=0;i<temp.length;i++){
                            var temp2 = temp[i].split("-");
                            temp2[1] = parseInt(temp2[1]);
                            temp2.push("#"+((1<<24)*Math.random()|0).toString(16));
                            plot.push(temp2);
                        }
                        
                        google.charts.load("current", {packages:["corechart"]});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                          var data = google.visualization.arrayToDataTable(plot);

                          var view = new google.visualization.DataView(data);
                          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" }, 2]);

                          var options = {
                            title: d,
                            width: 900,
                            height: 600,
                            bar: {groupWidth: "45%"},
                            legend: { position: "none" },
                          };
                          var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
                          chart.draw(view, options);
                      }
                    }
                });
            });
        });

    </script>
</body>
</html>