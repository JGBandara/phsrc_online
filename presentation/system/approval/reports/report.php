
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
    // Clone the table to avoid modifying the original
    var table = document.querySelector('table').cloneNode(true);

    // Remove last column (Action) from thead
    table.querySelectorAll('thead tr th:last-child').forEach(th => th.remove());

    // Remove last column from each row in tbody
    table.querySelectorAll('tbody tr').forEach(tr => {
        tr.querySelectorAll('td:last-child').forEach(td => td.remove());
    });
    
    // Remove hidden rows before printing
    table.querySelectorAll("tbody tr").forEach(tr => {
      if (tr.style.display === "none") tr.remove();
    });

    // Calculate total Registration Fee
    let total = 0;
    table.querySelectorAll("tbody tr").forEach(tr => {
        let fee = parseFloat(tr.children[3].innerText.replace(/,/g, '')); // 4th column = fee
        if (!isNaN(fee)) total += fee;
    });

    // Append total row
    let tfoot = document.createElement('tfoot');
    let totalRow = document.createElement('tr');
    totalRow.style.fontWeight = 'bold';
    totalRow.style.backgroundColor = '#333';
    totalRow.style.color = 'white';
    totalRow.innerHTML = `
        <td colspan="3" style="text-align:right;">Total Fees:</td>
        <td style="text-align:right;">${total.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits:2})}</td>
        <td colspan="2"></td>
    `;
    tfoot.appendChild(totalRow);
    table.appendChild(tfoot);

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
    newWin.document.write(table.outerHTML);
    newWin.document.write('</body></html>');
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



