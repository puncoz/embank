/******************************************************************************
*  xml-lib.js
* 	
*   Provides functionality to load categories in a cascading parent/child
*   relationship. (Read from Categories_list.xml)
******************************************************************************/

/*
 * Set GLOBAL variables
 */
var xmlPath="data/data.xml";
var imgPath="images/portfolio/";
var xmlDoc;
var c=null;
var c1=null;
var numClients;
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
	jQuery('#thumbs').jcarousel({
		initCallback: c_initCallback
	});
	// just to set the carousel var...
	function c_initCallback(carousel) {
		c=carousel;
	}
	
	var num = parseInt($.query.get('num'))-1;
	var start=0;
	if (num!=''){
		start=num;
	}
	
	// Initialize the vertical nav scroller
	jQuery('#port-nav').jcarousel({
		vertical: true,
		start: start,
		scroll: 8,
		initCallback: c1_initCallback
	});
	// just to set the carousel var...
	function c1_initCallback(carousel) {
		c1=carousel;
	}
	
	//alert("in ready");
	$.get(xmlPath,{},XmlOnLoad);
});

/*
 * Load XML data to 'document'
 */
function XmlOnLoad(xmlData,strStatus){
	// set our global XML data...
	setXmlData(xmlData);

	// loop over the sections and populate the occasions drop-down...
	var clients=$(xmlData).find("client");
	c1.size(clients.size());
	numClients=clients.size();
	$(clients).each(function(i){
		var clientId=$(this).attr('id');
		var clientName=$(this).attr('name');
		var li=GenerateClientLink(clientId,clientName,i);
		// add items to the carousel...
		c1.add(i+1,li);
		//$(li).appendTo('#port-nav');
		
		// we gotta load the first item in the xml doc...
		if (i == 0)	LoadClient(xmlData,clientId,i);
	});
	
	// event handlers...
	// click on a client
	$('#port-nav li a').click(function(){
		var clientId=$(this).attr("rel");
		var num=$(this).attr("num");
		LoadClient(getXmlData(),clientId,num);
		
		return false;
	});
	
	// gotta use livequery for dynamic elements...
	$('#thumbs li a').livequery('click', function(event) { 
		var desc=$(this).attr('desc');
		var imgSrc=$(this).attr('pimg');
		ShowPreview(imgSrc, desc);
		
		// remove the selected classname from the items
		$('#thumbs').children().each(function(i){
			//alert($(this).html());
			$(this).removeClass('active');
		});
		// select ('active') the one we just clicked
		$(this).parents('li').addClass('active');
		
        return false; 
    });
	
	// check to see if we have an id specified
	var id = $.query.get('id');
	var num = $.query.get('num');
	if (id!='') LoadClient(getXmlData(),id,num);
}

/*
 * Helper class to generate a client
 */
function GenerateClientLink(id,name,num){
	var itm="<table><tr><td><a href=\"#\" rel=\"" + id + "\" num=\"" + num + "\">" + name + "</a></td></tr></table>";
	return itm;
}

/*
 * Helper class to generate a thumbnail
 */
function GenerateThumbnail(thumb,preview,num,desc){
	var itm="<a href=\"#\" pimg=\"" + preview + "\" desc=\"" + desc + "\"><img src=\"" + imgPath + thumb + "\" alt=\"\" /></a>";
	return itm;
}

/*
 * Helper class to generate a screen
 */
function ShowPreview(imgSrc, desc){
	$('#ctr-screen-lg img').hide();
	$('#ctr-screen-lg img').attr("src",imgPath + imgSrc);
	$('#ctr-screen-lg img').attr("alt",desc);
	$('#ctr-screen-lg img').attr("title",desc);
	$('#ctr-screen-lg img').fadeIn(200);
}

/*
 * Load child nodes; aletrnatively navigate to 
 * URL if parent has no children
 */
function LoadClient(xmlData,id,num){
	// grab all the screens defined for this client....
	var selectedClientXml=$(xmlData).find("client[id='"+id+"']");
	var childElems=selectedClientXml.children();
	//alert(childElems.size());
	
	// Initialise the thumbnail scroller
	c.reset();
	c.size(childElems.size());
	c.reset(); // this assures that Safari plays nice with the carousel
	
	// remove all the thumbnails first...
	$('#thumbs').empty();
	
	// set the partner link (if one exists)...
	if (selectedClientXml.attr('partnerName')!=''){
		$('#ctr-collab').show();
		$('#ctr-collab a').text(selectedClientXml.attr('partnerName'));
		$('#ctr-collab a').attr('href',selectedClientXml.attr('partnerUrl'));
		$('#ctr-collab a').attr('target','_blank');
	} else {
		$('#ctr-collab').hide();
	}
	
	// loop over the screens and generate thumbnails
	childElems.each(function(i){
		var thumbImg=$(this).attr('thumb');
		var previewImg=$(this).attr('preview');
		var desc=$(this).attr('description');
		var a=GenerateThumbnail(thumbImg,previewImg,i,desc);
				
		// display the first item in the list...
		if (i == 0) ShowPreview(previewImg,desc);
		
		// add the thumbnails to the carousel...
		c.add(i+1,a);
	});

	// remove the selected classname from the items
	$('#port-nav').children().each(function(i){
		//alert($(this).html());
		$(this).removeClass('active');
	});
	// select ('active') the one we just clicked
	var selItm=parseInt(num)+1;
	$('#port-nav li.jcarousel-item-'+selItm).addClass('active');
	
	// 'select' the first item in thumbs
	$('#thumbs').find(":first-child").addClass('active');
}