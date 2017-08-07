<!DOCTYPE html>
<html lang="en">

	<head>
<title>Home</title>
      <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
      <script src="<?php echo base_url(); ?>assets/jquery/1.10.2/jquery-1.10.2.min.js"></script>

      <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url(); ?>assets/jquery/tablesorter/jquery.tablesorter.js" type="text/javascript"></script>


      
      <style>
      
         #wrapper {
            transition: all 0.4s ease 0s;
        }

        .sidebar-nav {
            position: absolute;
            top: 0;
            width: 250px;
            list-style: none;
            margin: 0;
            padding: 0;
      }
      .dropdown-menu li:hover .sub-menu {
    visibility: visible;
        }
      .dropdown-submenu {
    position: relative;
}
#content{
  margin-left:20%; margin-top:8%; padding:0pt; position:absolute; overflow:auto; max-height:45%;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
    display: block;
}

.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
    border-left-color: #fff;
}

.dropdown-submenu.pull-left {
    float: none;
}

.dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
}
.dropdown-mainmenu {
    position: relative;
}

.dropdown-mainmenu>.dropdown-menu {
    top: 100%;
    left: 10%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-mainmenu:hover>.dropdown-menu {
    display: block;
}
      </style>
      <script>
        function printReport(rprt)
            {
                          var contents = document.getElementById("rprt").innerHTML;
                          var frame1 = document.createElement('iframe');
                          frame1.name = "frame1";
                          frame1.style.position = "absolute";
                          frame1.style.top = "-1000000px";
                          document.body.appendChild(frame1);
                          var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                          frameDoc.document.open();
                          frameDoc.document.write('<html><head><title></title><link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"><style>  @media print { .container { width: auto; }} </style>');
                          frameDoc.document.write('</head><body>');
                          frameDoc.document.write(contents);
                          frameDoc.document.write('</body></html>');
                          frameDoc.document.close();
                          setTimeout(function () {
                              window.frames["frame1"].focus();
                              window.frames["frame1"].print();
                              document.body.removeChild(frame1);
                          }, 500);
                          return false;

                }
        function printMaleReport(malerep)
            {
                          var contents = document.getElementById("malerep").innerHTML;
                          var frame1 = document.createElement('iframe');
                          frame1.name = "frame1";
                          frame1.style.position = "absolute";
                          frame1.style.top = "-1000000px";
                          document.body.appendChild(frame1);
                          var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                          frameDoc.document.open();
                          frameDoc.document.write('<html><head><title></title><link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"><style>  @media print { .container { width: auto; }} </style>');
                          frameDoc.document.write('</head><body>');
                          frameDoc.document.write('<div><center><img src="<?php echo base_url(); ?>assets/images/print.png" style="height: 100px; width: 100px;"></center><center><h3>University of San Carlos </h3></center><center><p>Guidance and Testing Center Referral System Report</p></center></div><br><br><h2>List of Male students</h2><br>');
                          frameDoc.document.write(contents);
                          frameDoc.document.write('</body></html>');
                          frameDoc.document.close();
                          setTimeout(function () {
                              window.frames["frame1"].focus();
                              window.frames["frame1"].print();
                              document.body.removeChild(frame1);
                          }, 500);
                          return false;

                }
        function printFemaleReport(femrep)
            {
                          var contents = document.getElementById("femrep").innerHTML;
                          var frame1 = document.createElement('iframe');
                          frame1.name = "frame1";
                          frame1.style.position = "absolute";
                          frame1.style.top = "-1000000px";
                          document.body.appendChild(frame1);
                          var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                          frameDoc.document.open();
                          frameDoc.document.write('<html><head><title></title><link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"><style>  @media print { .container { width: auto; }} </style>');
                          frameDoc.document.write('</head><body>');
                          frameDoc.document.write('<div><center><img src="<?php echo base_url(); ?>assets/images/print.png" style="height: 100px; width: 100px;"></center><center><h3>University of San Carlos </h3></center><center><p>Guidance and Testing Center Referral System Report</p></center></div><br><br><h2>List of Female students</h2><br>');
                          frameDoc.document.write(contents);
                          frameDoc.document.write('</body></html>');
                          frameDoc.document.close();
                          setTimeout(function () {
                              window.frames["frame1"].focus();
                              window.frames["frame1"].print();
                              document.body.removeChild(frame1);
                          }, 500);
                          return false;

                }
                function printFirstyrReport(firstyrrep)
                    {
                                  var contents = document.getElementById("firstyrrep").innerHTML;
                                  var frame1 = document.createElement('iframe');
                                  frame1.name = "frame1";
                                  frame1.style.position = "absolute";
                                  frame1.style.top = "-1000000px";
                                  document.body.appendChild(frame1);
                                  var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                                  frameDoc.document.open();
                                  frameDoc.document.write('<html><head><title></title><link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"><style>  @media print { .container { width: auto; }} </style>');
                                  frameDoc.document.write('</head><body>');
                                  frameDoc.document.write('<div><center><img src="<?php echo base_url(); ?>assets/images/print.png" style="height: 100px; width: 100px;"></center><center><h3>University of San Carlos </h3></center><center><p>Guidance and Testing Center Referral System Report</p></center></div><br><br><h2>List of First Year students</h2><br>');
                                  frameDoc.document.write(contents);
                                  frameDoc.document.write('</body></html>');
                                  frameDoc.document.close();
                                  setTimeout(function () {
                                      window.frames["frame1"].focus();
                                      window.frames["frame1"].print();
                                      document.body.removeChild(frame1);
                                  }, 500);
                                  return false;

                        }
                        function printSecondyrReport(secondyrrep)
                            {
                                          var contents = document.getElementById("secondyrrep").innerHTML;
                                          var frame1 = document.createElement('iframe');
                                          frame1.name = "frame1";
                                          frame1.style.position = "absolute";
                                          frame1.style.top = "-1000000px";
                                          document.body.appendChild(frame1);
                                          var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                                          frameDoc.document.open();
                                          frameDoc.document.write('<html><head><title></title><link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"><style>  @media print { .container { width: auto; }} </style>');
                                          frameDoc.document.write('</head><body>');
                                          frameDoc.document.write('<div><center><img src="<?php echo base_url(); ?>assets/images/print.png" style="height: 100px; width: 100px;"></center><center><h3>University of San Carlos </h3></center><center><p>Guidance and Testing Center Referral System Report</p></center></div><br><br><h2>List of Second Year students</h2><br>');
                                          frameDoc.document.write(contents);
                                          frameDoc.document.write('</body></html>');
                                          frameDoc.document.close();
                                          setTimeout(function () {
                                              window.frames["frame1"].focus();
                                              window.frames["frame1"].print();
                                              document.body.removeChild(frame1);
                                          }, 500);
                                          return false;

                                }
                                function printThirdyrReport(thirdyrrep)
                                    {
                                                  var contents = document.getElementById("thirdyrrep").innerHTML;
                                                  var frame1 = document.createElement('iframe');
                                                  frame1.name = "frame1";
                                                  frame1.style.position = "absolute";
                                                  frame1.style.top = "-1000000px";
                                                  document.body.appendChild(frame1);
                                                  var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                                                  frameDoc.document.open();
                                                  frameDoc.document.write('<html><head><title></title><link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"><style>  @media print { .container { width: auto; }} </style>');
                                                  frameDoc.document.write('</head><body>');
                                                  frameDoc.document.write('<div><center><img src="<?php echo base_url(); ?>assets/images/print.png" style="height: 100px; width: 100px;"></center><center><h3>University of San Carlos </h3></center><center><p>Guidance and Testing Center Referral System Report</p></center></div><br><br><h2>List of Third Year students</h2><br>');
                                                  frameDoc.document.write(contents);
                                                  frameDoc.document.write('</body></html>');
                                                  frameDoc.document.close();
                                                  setTimeout(function () {
                                                      window.frames["frame1"].focus();
                                                      window.frames["frame1"].print();
                                                      document.body.removeChild(frame1);
                                                  }, 500);
                                                  return false;

                                        }
                                        function printFourthyrReport(fourthyrrep)
                                            {
                                                          var contents = document.getElementById("fourthyrrep").innerHTML;
                                                          var frame1 = document.createElement('iframe');
                                                          frame1.name = "frame1";
                                                          frame1.style.position = "absolute";
                                                          frame1.style.top = "-1000000px";
                                                          document.body.appendChild(frame1);
                                                          var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                                                          frameDoc.document.open();
                                                          frameDoc.document.write('<html><head><title></title><link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"><style>  @media print { .container { width: auto; }} </style>');
                                                          frameDoc.document.write('</head><body>');
                                                          frameDoc.document.write('<div><center><img src="<?php echo base_url(); ?>assets/images/print.png" style="height: 100px; width: 100px;"></center><center><h3>University of San Carlos </h3></center><center><p>Guidance and Testing Center Referral System Report</p></center></div><br><br><h2>List of Fourth Year students</h2><br>');
                                                          frameDoc.document.write(contents);
                                                          frameDoc.document.write('</body></html>');
                                                          frameDoc.document.close();
                                                          setTimeout(function () {
                                                              window.frames["frame1"].focus();
                                                              window.frames["frame1"].print();
                                                              document.body.removeChild(frame1);
                                                          }, 500);
                                                          return false;

                                                }
                            function printFifthyrReport(fifthyrrep)
                                {
                                              var contents = document.getElementById("fifthyrrep").innerHTML;
                                              var frame1 = document.createElement('iframe');
                                              frame1.name = "frame1";
                                              frame1.style.position = "absolute";
                                              frame1.style.top = "-1000000px";
                                              document.body.appendChild(frame1);
                                              var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                                              frameDoc.document.open();
                                              frameDoc.document.write('<html><head><title></title><link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"><style>  @media print { .container { width: auto; }} </style>');
                                              frameDoc.document.write('</head><body>');
                                              frameDoc.document.write('<div><center><img src="<?php echo base_url(); ?>assets/images/print.png" style="height: 100px; width: 100px;"></center><center><h3>University of San Carlos </h3></center><center><p>Guidance and Testing Center Referral System Report</p></center></div><br><br><h2>List of Fifth Year students</h2><br>');
                                              frameDoc.document.write(contents);
                                              frameDoc.document.write('</body></html>');
                                              frameDoc.document.close();
                                              setTimeout(function () {
                                                  window.frames["frame1"].focus();
                                                  window.frames["frame1"].print();
                                                  document.body.removeChild(frame1);
                                              }, 500);
                                              return false;

                                    }
                function printsafadReport(safadrep)
                    {
                                  var contents = document.getElementById("safadrep").innerHTML;
                                  var frame1 = document.createElement('iframe');
                                  frame1.name = "frame1";
                                  frame1.style.position = "absolute";
                                  frame1.style.top = "-1000000px";
                                  document.body.appendChild(frame1);
                                  var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                                  frameDoc.document.open();
                                  frameDoc.document.write('<html><head><title></title><link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"><style>  @media print { .container { width: auto; }} </style>');
                                  frameDoc.document.write('</head><body>');
                                  frameDoc.document.write('<div><center><img src="<?php echo base_url(); ?>assets/images/print.png" style="height: 100px; width: 100px;"></center><center><h3>University of San Carlos </h3></center><center><p>Guidance and Testing Center Referral System Report</p></center></div><br><br><h2>List of School of Architecture Fine Arts and Design students</h2><br>');
                                  frameDoc.document.write(contents);
                                  frameDoc.document.write('</body></html>');
                                  frameDoc.document.close();
                                  setTimeout(function () {
                                      window.frames["frame1"].focus();
                                      window.frames["frame1"].print();
                                      document.body.removeChild(frame1);
                                  }, 500);
                                  return false;

                        }
              function printsasReport(sasrep)
                  {
                                var contents = document.getElementById("sasrep").innerHTML;
                                var frame1 = document.createElement('iframe');
                                frame1.name = "frame1";
                                frame1.style.position = "absolute";
                                frame1.style.top = "-1000000px";
                                document.body.appendChild(frame1);
                                var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                                frameDoc.document.open();
                                frameDoc.document.write('<html><head><title></title><link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"><style>  @media print { .container { width: auto; }} </style>');
                                frameDoc.document.write('</head><body>');
                                frameDoc.document.write('<div><center><img src="<?php echo base_url(); ?>assets/images/print.png" style="height: 100px; width: 100px;"></center><center><h3>University of San Carlos </h3></center><center><p>Guidance and Testing Center Referral System Report</p></center></div><br><br><h2>List of School of Arts and Sciences students</h2><br>');
                                frameDoc.document.write(contents);
                                frameDoc.document.write('</body></html>');
                                frameDoc.document.close();
                                setTimeout(function () {
                                    window.frames["frame1"].focus();
                                    window.frames["frame1"].print();
                                    document.body.removeChild(frame1);
                                }, 500);
                                return false;

                      }
        function printshcpReport(shcprep)
            {
                          var contents = document.getElementById("shcprep").innerHTML;
                          var frame1 = document.createElement('iframe');
                          frame1.name = "frame1";
                          frame1.style.position = "absolute";
                          frame1.style.top = "-1000000px";
                          document.body.appendChild(frame1);
                          var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                          frameDoc.document.open();
                          frameDoc.document.write('<html><head><title></title><link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"><style>  @media print { .container { width: auto; }} </style>');
                          frameDoc.document.write('</head><body>');
                          frameDoc.document.write('<div><center><img src="<?php echo base_url(); ?>assets/images/print.png" style="height: 100px; width: 100px;"></center><center><h3>University of San Carlos </h3></center><center><p>Guidance and Testing Center Referral System Report</p></center></div><br><br><h2>List of School of Health Care Profession students</h2><br>');
                          frameDoc.document.write(contents);
                          frameDoc.document.write('</body></html>');
                          frameDoc.document.close();
                          setTimeout(function () {
                              window.frames["frame1"].focus();
                              window.frames["frame1"].print();
                              document.body.removeChild(frame1);
                          }, 500);
                          return false;

                }
          function printslgReport(slgrep)
            {
                          var contents = document.getElementById("slgrep").innerHTML;
                          var frame1 = document.createElement('iframe');
                          frame1.name = "frame1";
                          frame1.style.position = "absolute";
                          frame1.style.top = "-1000000px";
                          document.body.appendChild(frame1);
                          var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                          frameDoc.document.open();
                          frameDoc.document.write('<html><head><title></title><link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"><style>  @media print { .container { width: auto; }} </style>');
                          frameDoc.document.write('</head><body>');
                          frameDoc.document.write('<div><center><img src="<?php echo base_url(); ?>assets/images/print.png" style="height: 100px; width: 100px;"></center><center><h3>University of San Carlos </h3></center><center><p>Guidance and Testing Center Referral System Report</p></center></div><br><br><h2>List of School of Law and Governance students</h2><br>');
                          frameDoc.document.write(contents);
                          frameDoc.document.write('</body></html>');
                          frameDoc.document.close();
                          setTimeout(function () {
                              window.frames["frame1"].focus();
                              window.frames["frame1"].print();
                              document.body.removeChild(frame1);
                          }, 500);
                          return false;

                }
          function printsbeReport(sberep)
            {
                          var contents = document.getElementById("sberep").innerHTML;
                          var frame1 = document.createElement('iframe');
                          frame1.name = "frame1";
                          frame1.style.position = "absolute";
                          frame1.style.top = "-1000000px";
                          document.body.appendChild(frame1);
                          var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                          frameDoc.document.open();
                          frameDoc.document.write('<html><head><title></title><link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"><style>  @media print { .container { width: auto; }} </style>');
                          frameDoc.document.write('</head><body>');
                          frameDoc.document.write('<div><center><img src="<?php echo base_url(); ?>assets/images/print.png" style="height: 100px; width: 100px;"></center><center><h3>University of San Carlos </h3></center><center><p>Guidance and Testing Center Referral System Report</p></center></div><br><br><h2>List of School of Business and Economics students</h2><br>');
                          frameDoc.document.write(contents);
                          frameDoc.document.write('</body></html>');
                          frameDoc.document.close();
                          setTimeout(function () {
                              window.frames["frame1"].focus();
                              window.frames["frame1"].print();
                              document.body.removeChild(frame1);
                          }, 500);
                          return false;

                }
        function printsoedReport(soerep)
            {
                          var contents = document.getElementById("soedrep").innerHTML;
                          var frame1 = document.createElement('iframe');
                          frame1.name = "frame1";
                          frame1.style.position = "absolute";
                          frame1.style.top = "-1000000px";
                          document.body.appendChild(frame1);
                          var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                          frameDoc.document.open();
                          frameDoc.document.write('<html><head><title></title><link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"><style>  @media print { .container { width: auto; }} </style>');
                          frameDoc.document.write('</head><body>');
                          frameDoc.document.write('<div><center><img src="<?php echo base_url(); ?>assets/images/print.png" style="height: 100px; width: 100px;"></center><center><h3>University of San Carlos </h3></center><center><p>Guidance and Testing Center Referral System Report</p></center></div><br><br><h2>List of School of Education students</h2><br>');
                          frameDoc.document.write(contents);
                          frameDoc.document.write('</body></html>');
                          frameDoc.document.close();
                          setTimeout(function () {
                              window.frames["frame1"].focus();
                              window.frames["frame1"].print();
                              document.body.removeChild(frame1);
                          }, 500);
                          return false;

                }
        function printsoeReport(soerep)
          {
                        var contents = document.getElementById("soerep").innerHTML;
                        var frame1 = document.createElement('iframe');
                        frame1.name = "frame1";
                        frame1.style.position = "absolute";
                        frame1.style.top = "-1000000px";
                        document.body.appendChild(frame1);
                        var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                        frameDoc.document.open();
                        frameDoc.document.write('<html><head><title></title><link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"><style>  @media print { .container { width: auto; }} </style>');
                        frameDoc.document.write('</head><body>');
                        frameDoc.document.write('<div><center><img src="<?php echo base_url(); ?>assets/images/print.png" style="height: 100px; width: 100px;"></center><center><h3>University of San Carlos </h3></center><center><p>Guidance and Testing Center Referral System Report</p></center></div><br><br><h2>List of School of Engineering students</h2><br>');
                        frameDoc.document.write(contents);
                        frameDoc.document.write('</body></html>');
                        frameDoc.document.close();
                        setTimeout(function () {
                            window.frames["frame1"].focus();
                            window.frames["frame1"].print();
                            document.body.removeChild(frame1);
                        }, 500);
                        return false;

              }
        function printResult(res)
            {
               var contents = document.getElementById("res").innerHTML;
                          var frame1 = document.createElement('iframe');
                          frame1.name = "frame1";
                          frame1.style.position = "absolute";
                          frame1.style.top = "-1000000px";
                          document.body.appendChild(frame1);
                          var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                          frameDoc.document.open();
                          frameDoc.document.write('<html><head><title></title><link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"><style>  @media print { .container { width: auto; }} </style>');
                          frameDoc.document.write('</head><body>');
                          frameDoc.document.write(contents);
                          frameDoc.document.write('</body></html>');
                          frameDoc.document.close();
                          setTimeout(function () {
                              window.frames["frame1"].focus();
                              window.frames["frame1"].print();
                              document.body.removeChild(frame1);
                          }, 500);
                          return false;

                }

        function exportWord(rprt) {

           var html, link, blob, url, css;
           var today = new Date();
           var dd = today.getDate();
           var mm = today.getMonth()+1; //January is 0!
           var yyyy = today.getFullYear();

           if(dd<10) {
               dd='0'+dd
           } 

           if(mm<10) {
               mm='0'+mm
           } 

           today = mm+'/'+dd+'/'+yyyy;

           css = (
            '<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">' +
             '<style>' +
             '@page rprt{size: 841.95pt 595.35pt;mso-page-orientation: landscape;}' +
             'div.rprt {page: rprt;}' +
             '</style>'
           );

           html = document.getElementById(rprt).innerHTML;
           blob = new Blob(['\ufeff', css + html], {
             type: 'application/msword'
           });
           url = URL.createObjectURL(blob);
           link = document.createElement('A');
           link.href = url;
           link.download = today+"_Report";  // default name without extension 
           document.body.appendChild(link);
           if (navigator.msSaveOrOpenBlob ) navigator.msSaveOrOpenBlob( blob, today+"_Report"); // IE10-11
               else link.click();  // other browsers
           document.body.removeChild(link);
         };
      </script>
	 </head>