
  <meta charset="UTF-8">
  <title>Pagination table with search option</title>
<link rel="stylesheet" href="../../../css/grid_js/style.css">
<style>
 .avatar1-pic {
        width: 350px;
		height:20px
      }
      .profilImg {
        width: 250px;
		height:20px
      }
</style>
<style>
#printArea {
    font-size: 10px;
    line-height: 1.2;
    font-family: Arial, sans-serif;
}

#printArea table {
    width: 100%;
    border-collapse: collapse;
}

#printArea th, #printArea td {
    border: 1px solid #555;
    padding: 4px;
    text-align: left;
}

#printArea th {
    background:#333;
    color:#fff;
}

h2 {
    font-size: 14px;
}
</style>

</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

<body>
<!-- partial:index.partial.html -->
<div class="container">
      <div class="header_wrap">
        <div class="num_rows">
		
				<div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
			 		<select class  ="form-control" name="state" id="maxRows">
						 
						 
						 <option value="10">10</option>
						 <option value="15">15</option>
						 <option value="20">20</option>
						 <option value="50">50</option>
						 <option value="70">70</option>
						 <option value="100">100</option>
            <option value="5000">Show ALL Rows</option>
						</select>
			 		
			  	</div>
        </div>
        <div class="tb_search">
<input type="text" id="search_input_all" onKeyUp="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
        </div>
      </div>
      
<table class="table table-striped table-class" id= "table-id">
  
	
<thead class="bg-gradient-dark">
<tr>
		<th>Institute Category</th>
    <th>Institute Name</th>
    <th>Reg No</th>
		<th>Year of Registration</th>
    <th>Status</th>
		<th>Action</th>
	</tr>
  </thead>

	
  
    
</table>

<!--		Start Pagination -->
			<div class='pagination-container'>
				<nav>
				  
				</nav>
			</div>
      <div class="rows_count d-flex justify-content-start"></div>
      <!-- <div class="rows_count d-flex justify-content-start">Showing 11 to 20 of 91 entries</div> -->

<div class="d-flex justify-content-end mb-3">
  <form action="export_excel.php" method="post" class="me-2">
    <button id="btnExportExcel" class="btn btn-success">
      <i class="fas fa-file-excel"></i> Download Excel
    </button> &nbsp;&nbsp;&nbsp;
  </form>

  <button id="btnPrint" class="btn btn-primary" onclick="printTable()">
    <i class="fas fa-print"></i> Print
  </button>
</div>

<script>
function printTable() {
    // Clone the table to avoid modifying the original
    var table = document.querySelector('table').cloneNode(true);

    // Remove last column (Action) from thead
    table.querySelectorAll('thead tr th:last-child').forEach(th => th.remove());

    // Remove last column from each row in tbody
    table.querySelectorAll('tbody tr').forEach(tr => {
        tr.querySelectorAll('td:last-child').forEach(td => td.remove());
    });

    // Open new window and print
    var newWin = window.open('', '', 'width=1200,height=800');
    newWin.document.write('<html><head><title>Print</title>');
    newWin.document.write('<style>');
    newWin.document.write(`
        @media print {
            @page { margin: 0; }
            body { margin: 0; font-family: Arial, sans-serif; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #000; padding: 8px; text-align: left; }
            th { background-color: #343a40 !important; color: #fff !important; }
        }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #343a40; color: #fff; }
    `);
    newWin.document.write('</style></head><body>');
    newWin.document.write(table.outerHTML); // print only the modified table
    newWin.document.write('</body></html>');
    newWin.document.close();
    newWin.focus();
    newWin.print();
    newWin.close();
}
</script>

</div> <!-- 		End of Container -->


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" >
    
      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-header">
          
          <h4 class="modal-title"></h4>
          <button type="button" class="close" id="btnClose" data-dismiss="modal">&times;</button>
        </div>
        <div class="btn-group btn-group-justified">
    <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butBasicInfo'>Recommendations & Approvals</a>
    <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butStaffInfo'>Subcommittee Recommandations</a>
  </div>
        <div class="modal-body" style="margin-top:20px">
        <div id="basicInfo">
        <input type="hidden" id="txtId" name="txtId"/>
         <div class="form-row">
  <div class="form-group col-md-3 textMainTxtStyle">
    <i class="fa fa-calendar-check" style="color:#007bff"></i>
    &nbsp;Application Submitted Date
  </div>
  <div class="form-group col-md-3">
    :&nbsp;<label class="textStyle" id="lblSubDate"></label>
  </div>
  <div class="form-group col-md-3 textMainTxtStyle">
    <i class="fa fa-file-invoice-dollar" style="color:#17a2b8"></i>
    &nbsp;Payment Receipt Date
  </div>
  <div class="form-group col-md-3">
    :&nbsp;<label class="textStyle" id="lblPayDate"></label>
  </div>
</div>
<div class="form-row">

  <div class="form-group col-md-3">
  </div>

  <div class="form-group col-md-3">
  </div>
  
</div>
<div class="form-row">
  <div class="form-group col-md-3 textMainTxtStyle">
    <i class="fa fa-thumbs-up" style="color:#28a745"></i>
    &nbsp;PDHS Recommendation Date
  </div>
  <div class="form-group col-md-3">
    :&nbsp;<label class="textStyle" id="lblRecDate"></label>
  </div>

  <div class="form-group col-md-3 textMainTxtStyle">
    <i class="fa fa-share-square" style="color:#fd7e14"></i>
    &nbsp;Manager Operations Forwarded Date
  </div>
  <div class="form-group col-md-3">
    :&nbsp;<label class="textStyle" id="lblForDate"></label>
  </div>
  
</div>

<div class="form-row">
  <div class="form-group col-md-3 textMainTxtStyle">
    <i class="fa fa-user-check" style="color:#ffc107"></i>
    &nbsp;PHSRC Officer Checked Date
  </div>
  <div class="form-group col-md-3">
    :&nbsp;<label class="textStyle" id="lblCheDate"></label>
  </div>
  <div class="form-group col-md-3 textMainTxtStyle">
    <i class="fa fa-stamp" style="color:#6f42c1"></i>
    &nbsp;Secretary / PHSRC Approved Date
  </div>
  <div class="form-group col-md-3">
    :&nbsp;<label class="textStyle" id="lblSecDate"></label>
  </div>
</div>
<div class="form-row" style="display:none;">
  <div class="form-group col-md-3 textMainTxtStyle" type="hidden"> 
    <i class="fa fa-user-check" style="color:#ffc107" ></i>
    &nbsp;Reg No
  </div>
  <div class="form-group col-md-3" type="hidden">
    :&nbsp;<label class="textStyle" id="lblRegNo" ></label>
  </div>
  <div class="form-group col-md-3 textMainTxtStyle" type="hidden">
    <i class="fa fa-stamp" style="color:#6f42c1"></i>
    &nbsp;Institute Name
  </div>
  <div class="form-group col-md-3" type="hidden">
    :&nbsp;<label class="textStyle" id="lblInsName"></label>
  </div>
</div>

<div class="form-row">

</div>



<div class="form-row"></div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->     
<div id="staffInfo">
          <div class="form-row"><div class="form-group col-md-12 textMainTxtStyle">Sub-Committee Recommendations</div></div>
        
          <div class="card" >
                <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblsubCommittee" style="overflow:auto">
                    <thead class="">
                      <tr>
                        <th style="width: 20%;">Member</th>
                        <th style="width: 20%;">Name</th>
                        <th style="width: 12%;">Status</th>
                        <th style="width: 12%;">Date</th>
                      </tr>
                    </thead>
                    
                  </table>
                </div>
              </div>      
        
             

        
        </div>
  <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->      
        
        
        </div>
        <div class="modal-footer">
          
         <div style=""><b><label id="lblAcction" style="font-size:36px;"></label></b></div><div class="col-md-5">&nbsp;</div> <center><button id="btnDownloadPDF" class="btn btn-primary">
    <i class="fa fa-file-pdf"></i> Download PDF
</button>
</center>
        </div>
      </div>
      
    </div>
  </div>
<script>
$("#btnDownloadPDF").click(function () {
    var sections = [
        { id: "basicInfo", title: "Basic Information" },
        { id: "staffInfo", title: "Staff Information" }
    ];

    var pdfContent = $("<div></div>");

    pdfContent.append("<style>" +
        "body { font-family: Arial, sans-serif; font-size: 10px; line-height:1.2; }" +
        "h1 { font-size: 14px; margin-bottom: 5px; text-align:center; }" +
        "h2 { color: #0d6efd; font-size: 12px; margin-top: 15px; margin-bottom:5px; }" +
        "table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }" +
        "th, td { border: 1px solid #555; padding: 4px; text-align: left; font-size:10px; }" +
        "th { background-color: #343a40; color: #fff; }" +
        "</style>");

    var regNo = $("#lblRegNo").text() || "-";
    var instituteName = $("#lblInsName").text() || "-";
    pdfContent.append("<h1>Registration No: " + regNo + " | Institute Name: " + instituteName + "</h1>");

    sections.forEach(function(section) {
        var sec = $("#" + section.id);
        var wasHidden = sec.css("display") === "none";
        if (wasHidden) sec.show();
        $("#lblRegNo").hide();
        $("#lblInsName").hide();

        var clonedSec = sec.clone();

        if (section.id === "paymentInfo") {
            clonedSec.find("table tr").each(function() {
                $(this).find("th:last-child, td:last-child").remove();
            });
        }

        pdfContent.append("<h2>" + section.title + "</h2>");
        pdfContent.append(clonedSec);

        if (wasHidden) sec.hide();
    });

    var opt = {
        margin:       10,
        filename:     'Institute_Details.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2, useCORS: true },
        jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(pdfContent[0]).save();
});

</script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
 <script src="<?php echo $backwardSeparator;?>js/dms.js"></script>
<script  src="../../../../js/grid_js/script.js"></script>
<script  src="list.js"></script>



