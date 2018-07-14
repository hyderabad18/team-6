function changeToUpperCase(fieldID){
	$("#"+fieldID).prop("value",$("#"+fieldID).val().toUpperCase())
}
function IsEmptyInputField(fieldID,errorText){
	$InField=$("#"+fieldID);
	$InField.css({"background-color":"",border:"1px solid #AAAAAA"});
	var b=$InField.val().trim();
	if(errorText==null||errorText.trim()==""){
		errorText="Field cannot be left blank";
	}
	if(b==""||b==null){
		$InField.css({"background-color":"#FF9999"});
		$InField.focus();
		$InField.tooltip({tooltipClass:"ui-state-highlight"}).prop("title",errorText).tooltip("open");
		setTimeout(function(){$InField.tooltip("close").prop("title","")},2000);
		return false;
	}
	return true;
}

function errorInputField(fieldID,errorMsg){
	if(errorMsg==null||errorMsg.trim()==""){
		errorMsg="Field cannot be left blank";
	}
	$InField=$("#"+fieldID);
	$InField.css({"background-color":"#FF9999"});
	$InField.focus();
	$InField.tooltip({tooltipClass:"ui-state-highlight"}).prop("title",errorMsg).tooltip("open");
	setTimeout(function(){$InField.tooltip("close").prop("title","")},2000);
	return false;
};

function handleAjaxError(jqXHRObj,textStatus,errorThrown){
    var vStatusText;
    var vStatusArray={"0":"Server unreachable","400":"Server understood the request, but request content was invalid.","401":"Unauthorized access.","403":"Forbidden resource can't be accessed.","404":"Requested Page/Resource not found","500":"Internal server error.","503":"Service unavailable."};
    switch(jqXHRObj.status){
        case 0:
        return false;
        break;
        default:
            vStatusText=vStatusArray[jqXHRObj.status];
            if(!vStatusText){
                if(textStatus=="parsererror"){
                        vStatusText="Error: Parsing JSON Request failed."
                }else{
                    if(textStatus=="timeout"){
                        vStatusText="Request Time out.";
                    }else{
                        if(textStatus=="abort"){
                            vStatusText="Request was aborted by the server"
                        }else{
                            vStatusText=errorThrown;
                        }
                    }
                }
            }
            alert(vStatusText);
        break;
    }
}