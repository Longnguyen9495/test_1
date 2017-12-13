/***
 * APE JSF Setup
 */
//APE.Config.baseUrl = 'http://cucre.vn/js/ape'; //APE JSF 
//APE.Config.domain = 'auto'; 
//APE.Config.server = 'ape.cucre.vn:6969'; //APE server URL

APE.Config.baseUrl = 'http://diepcd.com:9004/js/ape'; //APE JSF 
APE.Config.domain = 'auto'; 
APE.Config.server = 'ape.diepcd.com:443'; //APE server URL

(function(){
	for (var i = 0; i < arguments.length; i++)
		APE.Config.scripts.push(APE.Config.baseUrl + '/Source/' + arguments[i] + '.js');
})('mootools-core', 'Core/APE', 'Core/Events', 'Core/Core', 'Pipe/Pipe', 'Pipe/PipeProxy', 'Pipe/PipeMulti', 'Pipe/PipeSingle', 'Request/Request','Request/Request.Stack', 'Request/Request.CycledStack', 'Transport/Transport.longPolling','Transport/Transport.SSE', 'Transport/Transport.XHRStreaming', 'Transport/Transport.JSONP', 'Core/Utility', 'Core/JSON');
