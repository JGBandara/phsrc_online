
  <meta charset="UTF-8">
  <title>Pagination table with search option</title>
  <!--<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>-->
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
</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
      <div class="header_wrap">
    <div class="d-flex align-items-center mb-3">
  <label class="me-2">From:</label>
  <input type="date" id="fromDate" class="form-control me-2" style="width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <label class="me-2" >To:</label>
  <input type="date" id="toDate" class="form-control me-2" style="width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;
  <button id="filterBtn" class="btn btn-primary" style="margin-left:50px;">Search</button>
</div>

        <div class="num_rows">
		
				<div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
			 		<select class  ="form-control" name="state" id="maxRows">
						 <option value="10">10</option>
						 <option value="15">15</option>
						 <option value="20">20</option>
						 <option value="50">50</option>
						 <option value="70">70</option>
						 <option value="100">100</option>
            <            <option value="5000">Show ALL Rows</option>
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
		<th>Institute Name</th>
		<th>Reg Type</th>
    <th>Category</th>
		<th>Date</th>
    <th>Registration Fee</th>
    <th>Status</th>
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
<form id="excelForm" action="export_excel.php" method="POST">
    <input type="hidden" name="excelData" id="excelData">
  <button type="button" id="btnExportExcel" class="btn btn-success">
    <i class="fas fa-file-excel"></i> Download Excel
  </button>&nbsp;&nbsp;&nbsp;&nbsp;
</form>


  <button id="btnPrint" class="btn btn-primary" onclick="printTable()">
    <i class="fas fa-print"></i> Print
  </button>
</div>

<script>
function printTable() {
    var table = document.querySelector('table').cloneNode(true);

    // Remove last column (actions)
    table.querySelectorAll('thead tr th:last-child, tbody tr td:last-child')
        .forEach(el => el.remove());

    // Add sequence numbers
    let seq = 1;
    let headerRow = table.querySelector("thead tr");
    let thSeq = document.createElement("th");
    thSeq.innerHTML = "#";
    headerRow.insertBefore(thSeq, headerRow.firstChild);

    table.querySelectorAll("tbody tr").forEach(tr => {
        let td = document.createElement("td");
        td.innerText = seq++;
        tr.insertBefore(td, tr.firstChild);
    });

    // Remove hidden rows
    table.querySelectorAll("tbody tr").forEach(tr => {
        if (tr.style.display === "none") tr.remove();
    });

    // Calculate total
    let total = 0;
    table.querySelectorAll("tbody tr").forEach(tr => {
        let fee = parseFloat(tr.children[5].innerText.replace(/,/g, ''));
        if (!isNaN(fee)) total += fee;
    });

    let provincialFee = total * 0.50;

    // Create footer section shown only once
    let tfoot = document.createElement("tfoot");

    let totalRow = document.createElement("tr");
    totalRow.style.fontWeight = "bold";
    totalRow.style.backgroundColor = "#343a40";
    totalRow.style.color = "white";
    totalRow.innerHTML = `
        <td colspan="5" style="text-align:right;">Total Registration Fees:</td>
        <td>${total.toLocaleString(undefined, { minimumFractionDigits: 2 })}</td>
    `;

    let provRow = document.createElement("tr");
    provRow.style.fontWeight = "bold";
    provRow.style.backgroundColor = "#343a40";
    provRow.style.color = "white";
    provRow.innerHTML = `
        <td colspan="5" style="text-align:right;">Provincial Fees (50%):</td>
        <td>${provincialFee.toLocaleString(undefined, { minimumFractionDigits: 2 })}</td>
    `;

    tfoot.appendChild(totalRow);
    tfoot.appendChild(provRow);
    table.appendChild(tfoot);

    // PRINT WINDOW
    var newWin = window.open("", "", "width=1200,height=800");
    newWin.document.write(`<html><head><title>Print</title>
        <style>
            @media print {
                @page { margin: 10mm; }
                body { font-family: Arial, sans-serif; }
                table { width: 100%; border-collapse: collapse; page-break-inside: auto; }
                tr { page-break-inside: avoid; }
                th, td { border: 1px solid #000; padding: 6px; }
                th { background-color: #343a40; color: white; }
                tfoot { display: table-row-group; page-break-inside: avoid; page-break-after: auto; }
            }
        </style>
    </head><body>`);

    newWin.document.write(table.outerHTML);
    newWin.document.write("</body></html>");
    newWin.document.close();
    newWin.focus();
    newWin.print();
    newWin.close();
}

</script>


<script>
document.getElementById("filterBtn").addEventListener("click", function () {
    const from = new Date(document.getElementById("fromDate").value);
    const to = new Date(document.getElementById("toDate").value);

    document.querySelectorAll("#table-id tbody tr").forEach(row => {
        const dateText = row.querySelector("td.date-column").innerText;
        const rowDate = new Date(dateText);

        if ((isNaN(from) || rowDate >= from) && (isNaN(to) || rowDate <= to)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});

</script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
<script src="<?php echo $backwardSeparator;?>js/dms.js"></script>
<script  src="../../../../js/grid_js/script.js"></script>
<script  src="list.js"></script>



