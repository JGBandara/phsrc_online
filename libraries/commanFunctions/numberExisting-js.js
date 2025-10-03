var existingMsgDate = "";
var getAvailability = 0;
var getTransactionDate = 0;
//===================================================
function numberExisting(sender, type)
{
	var value = sender.value;
	var cntId = sender.id;
	var url = backDateSeperator + "commanFunctions/numberExisting.php?requestType=getAvailability&docNo="+value+"&docType="+type;
	var obj = $.ajax({url:url,async:false});
	if(obj.responseText > 0)
	{
		$('#'+cntId).validationEngine('showPrompt', 'This number is already exist.', 'fail');
		var t=setTimeout("alertx()",3000);
		getAvailability = 1;
	}
	else
	{
		getAvailability = 0;
	}
}
//===================================================

//===================================================
function backDateExisting(sender, type)
{
	existingMsgDate = "";
	var value = sender.value;
	var cntId = sender.id;
	var url = backDateSeperator + "commanFunctions/numberExisting.php?requestType=getTransactionDate&backDate="+value+"&docType="+type;
	var obj = $.ajax({url:url,async:false});
	if(obj.responseText == 'fNO')
	{
		$('#'+cntId).validationEngine('showPrompt', 'This transaction cannot allow future dates', 'fail');
		var t=setTimeout("alertx()",5000);
		getTransactionDate = 1;
		existingMsgDate = "This transaction cannot allow future dates";
	}
	else if(obj.responseText == 'bNO')
	{
		$('#'+cntId).validationEngine('showPrompt', 'This transaction cannot allow back dates', 'fail');
		var t=setTimeout("alertx()",5000);
		getTransactionDate = 1;
		existingMsgDate = "This transaction cannot allow back dates";
	}
	else if(obj.responseText == 'todayNO')
	{
		$('#'+cntId).validationEngine('showPrompt', 'This transactions is disallowed today', 'fail');
		var t=setTimeout("alertx()",5000);
		getTransactionDate = 1;
		existingMsgDate = "This transactions is disallowed today";
	}
	else
	{
		getTransactionDate = 0;
		existingMsgDate = "";
	}
}
//===================================================