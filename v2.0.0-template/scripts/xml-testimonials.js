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
var xmlDoc;
var interval=10000; // 10 seconds

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
	//alert("in ready");
	$.get(xmlPath,{},XmlOnLoad);
});

/*
 * Mimics the trim function in most languages...
 */
String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g,"");
}

/*
 * Load XML data to 'document'
 */
function XmlOnLoad(xmlData,strStatus){
	// set our global XML data...
	setXmlData(xmlData);
	LoadTestimonial();
	window.setTimeout(LoadTestimonial,interval,true);
}

function LoadTestimonial() {
	// loop over the sections and populate the occasions drop-down...
	var testimonials=$(getXmlData()).find("testimonial");
	var randNum = Math.floor((testimonials.size())*Math.random()) + 1;
	var randTestimonial=$(getXmlData()).find("testimonial[num='"+randNum+"']");
	
	// first, hide the testimonials container...
	$('#tst').hide();
	// set the values of testimonials
	$('#tst-text').html('"'+randTestimonial.text().trim()+'"');
	$('#tst-author').html(randTestimonial.attr('author'));
	$('#tst-company').html(randTestimonial.attr('company'));
	$('#tst').fadeIn(300);
	
	// call this method recursively evenr x seconds (set in interval above)
	window.setTimeout(LoadTestimonial,interval,true);
}