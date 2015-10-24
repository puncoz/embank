/******************************************************************************
*  xml-featured.js
* 	
*   Features a client from the data/Portfolio.xml file.
******************************************************************************/

/*
 * Set GLOBAL variables
 */
var xmlPath="data/data.xml";
var xmlDoc;
function setXmlData(xml){
	xmlDoc=xml;
}
function getXmlData(){
	return xmlDoc;
}

/*
 * Core fucntions & Methods
 */
$(document).ready(function(){
	$.get(xmlPath,{},WriteClient);
});

/*
 * Load XML data to 'document'
 */
function WriteClient(xmlData,strStatus){
	// set our global XML data...
	setXmlData(xmlData);

	// loop over the sections and populate the occasions drop-down...
	var clients=$(xmlData).find("client");
	$(clients).each(function(i){
		var isFeatured=$(this).attr('isFeatured');
		if (isFeatured=='true'){
			var clientId=$(this).attr('id');
			var clientName=$(this).attr('name');
			var clientDesc=$(this).attr('desc');
			$('#cli-name').html(WriteLink(clientId,clientName,i));
			$('#cli-desc').html(clientDesc);
			$('#cli-img').html(WriteLink(clientId,'<img src="images/img_featured_client.png" alt="Featured Client" />',i));	
		}		
	});	
}

/*
 * Helper function for writing client link
 */
function WriteLink(id,name,num){
	return "<a href=\"portfolio.htm?id="+id+"&num="+num+"\">"+name+"</a>";
}