function themeurl_pet() {
        var i = 0,
        got = -1,
        url,
        len = document.getElementsByTagName('link').length;
        while (i <= len && got == -1) {
            url = document.getElementsByTagName('link')[i].href;
            got = url.indexOf('/style.css');
            i++
        }
        return url.replace(/\/style.css.*/g, "")
    };
var swfUrl_pet = themeurl_pet();
swfUrl_pet+="/swf/Mouse_Pet.swf";
LoadPetParts();
function LoadPetParts(){
	var sUrl = swfUrl_pet;
	var sHtml = "";
	sHtml += '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="240"height="180">';
	sHtml +='<param name="movie" value="'+sUrl+'">';
	sHtml +='<param name="quality" value="high">';
	sHtml +='<param name="wmode" value="opaque">';
	sHtml +='<embed src="'+sUrl+'" width="240"  height="180" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="opaque">';
	sHtml += '</object>';
	document.write(sHtml);
}
