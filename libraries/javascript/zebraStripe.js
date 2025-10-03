
 $(document).ready(function() {
			/* zebra stripe the tables (not necessary for scrolling) */
	        var tbl = $("table.tbl1");
	        addZebraStripe(tbl);
	        addMouseOver(tbl);
			
			/* make the table scrollable with a fixed header */
	        //$("table.scroll").createScrollableTable({
//	            width: '800px',
//	            height: '400px'
//	        });

	    });

	    function addZebraStripe(table) {
            table.find("tbody tr:odd").addClass("alt");
        }

        function addMouseOver(table) {
            table.find("tbody tr").hover(
                    function() {
                        $(this).addClass("over");
                    },
                    function() {
                        $(this).removeClass("over");
                    }
                );
        }