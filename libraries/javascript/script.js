function errormsg(status)
{
	 switch (status) {
	 case 404:
		 return('File not found');
	 case 500:
		 return('Server error');
	 case 0:
		 return('Request aborted');
	 default:
		 return('Unknown error  :' + status);
	} 	
}

function chk(value)
{
	return (value==1?true:false);
}
////////////////////////COMMON LOAD COMBO FUNCTIONS       ////////////////////////////////////////////////
function combo_brand(customerId)
{
		var url 		= mainPath+"libraries/php/loadCombo.php?type=brand&customerId="+customerId;
		var httpobj 	= $.ajax({url:url,async:false})
		return httpobj.responseText;	
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////// popup box alert //////////////////////////////////////////////
/***************************/
//@Author: Adrian "yEnS" Mato Gondelle
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

//SETTING UP OUR POPUP
//0 means disabled; 1 means enabled;
var popupStatus = 0;

//loading popup with jQuery magic!
var cboFrom ='';
var cboTo	 = '';
var pageTo = '';
var x  = '';

function popupWindow2(i,from,to,page){
	
	//loads popup only if it is disabled
	$('#frmItem').validationEngine('hide');
	cboFrom = from;
	cboTo = to;
	pageTo = page;
	x = i;
	centerPopup();
		
	if(popupStatus==0){
		$("#backgroundPopup").css({
			"opacity": "0.7"
		});
		//$("#backgroundPopup").fadeIn("slow");
		//$("#popupContact"+x).fadeIn("slow");
		$("#backgroundPopup").fadeIn("slow");
		$("#popupContact"+x).fadeIn("slow");
		popupStatus = 1;
	}
	
		$("#iframeMain"+x).contents().find("#header").hide();
		$("#iframeMain"+x).contents().find("#butClose").parent().attr('href','');
		$("#iframeMain"+x).contents().find("#butClose").parent().click(disablePopup);

}

function popupWindow(i){
	//loads popup only if it is disabled
	$('#frmItem').validationEngine('hide');
	x = i;
	centerPopup();
		
	if(popupStatus==0){
		$("#backgroundPopup").css({
			"opacity": "0.7"
		});
		//$("#backgroundPopup").fadeIn("slow");
		//$("#popupContact"+x).fadeIn("slow");
		$("#backgroundPopup").fadeIn("slow");
		$("#popupContact"+x).fadeIn("slow");
		popupStatus = 1;
	}
		$("#iframeMain"+x).contents().find("#header").hide();
		$("#iframeMain"+x).contents().find("#butClose").parent().attr('href','');
		$("#iframeMain"+x).contents().find("#butClose").click(disablePopup2);
}

function popupWindow3(i){
	//loads popup only if it is disabled
	
	x = i;
	centerPopup();
		
	if(popupStatus==0){
		$("#backgroundPopup").css({
			"opacity": "0.7"
		});
		//$("#backgroundPopup").fadeIn("slow");
		//$("#popupContact"+x).fadeIn("slow");
		$("#backgroundPopup").fadeIn("slow");
		$("#popupContact"+x).fadeIn("slow");
		popupStatus = 1;
	}
		//$("#iframeMain"+x).contents().find("#header").hide();
		//$("#iframeMain"+x).contents().find("#butClose").parent().attr('href','');
		//$("#iframeMain"+x).contents().find("#butClose").parent().click(disablePopup2);

}

//disabling popup with jQuery magic!
function disablePopup(){
	//disables popup only if it is enabled
	if(popupStatus==1){
		//$("#backgroundPopup").fadeOut("slow");
		//$("#popupContact"+x).fadeOut("slow");
		$("#backgroundPopup").hide();
		$("#popupContact"+x).hide() ;
		popupStatus = 0;
		
		//var x = $("#iframeMain").contents().find("#butSearch").attr('val');
		//alert(x);
		var m = $("#iframeMain"+x).contents().find(cboFrom).html();
		//alert(m);
		$(pageTo+" "+cboTo).html(m);
		//$('#frmItem').validationEngine('hide');
	}
}
function disablePopup2(){
	//disables popup only if it is enabled
	if(popupStatus==1){
		//$("#backgroundPopup").fadeOut("slow");
		//$("#popupContact"+x).fadeOut("slow");
		$("#backgroundPopup").hide();
		$("#popupContact"+x).hide();
		popupStatus = 0;
		
		//var x = $("#iframeMain").contents().find("#butSearch").attr('val');
		//alert(x);
		//var m = $("#iframeMain"+x).contents().find("#"+cboFrom).html();
		//$("#"+pageTo+" #"+cboTo).html(m);
		$('#frmItem').validationEngine('hide');
	}
	closePopUp();
}

function showWaiting()
{
		var popupbox = document.createElement("div");
		var windowWidth = document.documentElement.clientWidth;
		var windowHeight = document.documentElement.clientHeight;
		var scrollH = (document.body.scrollHeight);
		//alert(windowHeight);
   popupbox.id = "divBackGroundBalck";
   popupbox.style.position = 'absolute';
   popupbox.style.zIndex = 100;
   popupbox.style.textAlign = 'center';
   popupbox.style.left = 0 + 'px';
   popupbox.style.top = 0 + 'px'; 
   popupbox.style.background="#000000"; 
   popupbox.style.width = screen.width + 'px';
   popupbox.style.height =  (scrollH)+ 'px';
   popupbox.style.opacity = 0.5;
   popupbox.style.color = "#FFFFFF";
	document.body.appendChild(popupbox);
	//document.getElementById('divBackGroundBalck').innerHTML = "this is text code";
	var popupbox1 = document.createElement("div");
	 popupbox1.id = "divBackgroundImg";
   popupbox1.style.position = 'absolute';
   popupbox1.style.zIndex = 101;
   popupbox1.style.verticalAlign = 'center';
   popupbox1.style.left =  windowWidth/2-100/2 +'px';
   popupbox1.style.top = ($(window).scrollTop()+200) + 'px'; 
   popupbox1.style.width = '100px';
   popupbox1.style.height =  '100px';
   popupbox1.style.opacity = 1;
   popupbox1.style.color = "#FFFFFF";
	document.body.appendChild(popupbox1);
	
	//alert(mainPath);
	document.getElementById('divBackgroundImg').innerHTML = "<img src=\""+projectName+"/images/loading_go.gif\" /><span class=\"normalfnt\" style=\"color:white;\">Please Wait...</span>";
	
}

function hideWaiting()
{
	try
	{
		var box = document.getElementById('divBackGroundBalck');
		box.parentNode.removeChild(box);
		
		var box1 = document.getElementById('divBackgroundImg');
		box1.parentNode.removeChild(box1);
		
	}
	catch(err)
	{        
	}	
}
//centering popup
function centerPopup(){
	//request data for centering
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	//alert(windowHeight);
	
	var popupHeight = $("#popupContact"+x).height();
	var popupWidth = $("#popupContact"+x).width();
	//alert(window.outerHeight);
	//centering
	$("#popupContact"+x).css({
		"position": "absolute",
		//"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2,
		"top":$(window).scrollTop()+30
		
		
	});
	
	//$("#popupContact").html("<iframe  id=\"iframeMain\" name=\"iframeMain\""+
				//"src=\""+url+"\" style=\"width:800;height:400;border:0\">"+
    			//"</iframe>");
	//only need force for IE6
	
	$("#backgroundPopup").css({
		"height": window.outerHeight//"height": windowHeight
	});
	
}

function removeLastChar(value)
{
	return value.substr(0,value.length-1);
}


//CONTROLLING EVENTS IN jQuery
$(document).ready(function(){
	
	//LOADING POPUP
	//Click the button event!

	//CLOSING POPUP
	//Click the x event!
	$("#popupContactClose").click(function(){
		disablePopup();
		
	});
	//Click out event!
	$("#backgroundPopup").click(function(){
		disablePopup();
	});
	//Press Escape event!
	$(document).keypress(function(e){
		if(e.keyCode==27 && popupStatus==1){
			disablePopup();
			
		}
	});
	
	

});

function inc(filename)
{				
	var body = document.getElementsByTagName('body').item(0);				
	script = document.createElement('script');				
	script.src = filename;
	script.type = 'text/javascript';				
	body.appendChild(script);
}	

function URLEncode(url)//URLEncode
{
	url = url.replace(/"/gi,'\\"');
	url = url.replace(/'/gi,"\\'");
	//alert(url);
	//strBuyerPo = strBuyerPo.replace(/#/gi,"***");
	
	url = "" + url + "";
	url = url.replace("&amp;", "&");
	// The Javascript escape and unescape functions do not correspond
	// with what browsers actually do...
	var SAFECHARS = "0123456789" +					// Numeric
					"ABCDEFGHIJKLMNOPQRSTUVWXYZ" +	// Alphabetic
					"abcdefghijklmnopqrstuvwxyz" +
					"-_.!~*'()";					// RFC2396 Mark characters
	var HEX = "0123456789ABCDEF";

	var plaintext = url;
	var encoded = "";
	for (var i = 0; i < plaintext.length; i++ ) {
		var ch = plaintext.charAt(i);
	    if (ch == " ") {
		    encoded += "+";				// x-www-urlencoded, rather than %20
		} else if (SAFECHARS.indexOf(ch) != -1) {
		    encoded += ch;
		} else {
		    var charCode = ch.charCodeAt(0);
			if (charCode > 255) {
				/*
			    alert( "Unicode Character '" 
                        + ch 
                        + "' cannot be encoded using standard URL encoding.\n" +
				          "(URL encoding only supports 8-bit characters.)\n" +
						  "A space (+) will be substituted." );
				encoded += "+";
				*/
			} else {
				encoded += "%";
				encoded += HEX.charAt((charCode >> 4) & 0xF);
				encoded += HEX.charAt(charCode & 0xF);
			}
		}
	} // for

	//document.URLForm.F2.value = encoded;
  //document.URLForm.F2.select();
	return encoded;
}

 function DisableContextMenu()
 {
   return false;
 }
 
 function EnableRightClickEvent()
 {
	 document.oncontextmenu = null;
	  return false;
 }
 
 function DisableRightClickEvent()
 {
	  document.oncontextmenu = DisableContextMenu;
	  return false;
 }
  function ControlableKeyAccess(evt)
  {
	 var charCode = (evt.which) ? evt.which : evt.keyCode;


	 if (charCode == 9)
		return true;

	 return false;

  }