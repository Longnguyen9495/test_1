// Check xem trình duyệt là IE6 hay IE7
var isIE		= (navigator.userAgent.toLowerCase().indexOf("msie") == -1 ? false : true);
var isIE6	= (navigator.userAgent.toLowerCase().indexOf("msie 6") == -1 ? false : true);
var isIE7	= (navigator.userAgent.toLowerCase().indexOf("msie 7") == -1 ? false : true);
var isChrome= (navigator.userAgent.toLowerCase().indexOf("chrome") == -1 ? false : true);

function windowPrompt(data){

	$(".wPrompt").remove();

	var wPromptOpts	= {
		wPromptWrapper	: "wPromptWrapper",
		width			: "auto",
		height		: "auto",
		title			: "",
		content		: "",
		comment		: "",
		fixed			: true,
		showBottom	: true,
		href			: null,
		ajax			: false,
		iframe		: false,
		overlay		: true,
		overlayClose: true,
		alert			: false,
		confirm		: false,

		onOpen		: null,
		onComplete	: null,
		onCleanup	: null,
		onClosed		: null
	};

	var optsAlert	= {
		value			: "Đồng ý",
		callback		: null
	};

	var optsConfirm= {
		valueTrue	: "Đồng ý",
		valueFalse	: "Từ chối",
		callback		: null
	};

	if(arguments.length == 2){
		wPromptOpts.title	= arguments[0];
		data			= arguments[1];
	}

	// Extent data
	if(typeof(data) == "object"){
		$.extend(wPromptOpts, data);
		if(wPromptOpts.alert !== false || wPromptOpts.confirm !== false){
			// Khi alert, confirm cho showBottom mặc định = false
			if(typeof(data.showBottom) == "undefined") wPromptOpts.showBottom = false;
		}
	}

	// Extent alert
	if(typeof(wPromptOpts.alert) == "object") $.extend(optsAlert, wPromptOpts.alert);
	else if(typeof(wPromptOpts.alert) == "function") optsAlert.callback = wPromptOpts.alert;

	// Extent confirm
	if(typeof(wPromptOpts.confirm) == "object") $.extend(optsConfirm, wPromptOpts.confirm);
	else if(typeof(wPromptOpts.confirm) == "function") optsConfirm.callback = wPromptOpts.confirm;

	// Get DOM element
	domEleWindowPrompt	= function(){
		domEle	= $(".wPrompt, .wPromptOverlay");
		domEle	= $.extend(domEle, {wPrompt: $(".wPrompt"), wPromptOverlay: $(".wPromptOverlay")});
		return domEle;
	};

	// Alert function
	alertWindowPrompt	= function(){
		closeWindowPrompt();
		if(typeof(optsAlert.callback) == "function") optsAlert.callback();
	};

	// Confirm function
	confirmWindowPrompt	= function(confirm){
		closeWindowPrompt();
		if(typeof(optsConfirm.callback) == "function") optsConfirm.callback(confirm);
	};

	// Close function
	closeWindowPrompt = function(){
		if(typeof(wPromptOpts.onCleanup) == "function") wPromptOpts.onCleanup(domEleWindowPrompt());
		$(".wPrompt, .wPromptOverlay").remove();
		if(typeof(wPromptOpts.onClosed) == "function") wPromptOpts.onClosed();
	};

	if(typeof(data) == "object"){
		// Ajax
		if(wPromptOpts.ajax && wPromptOpts.href !== null) wPromptOpts.content	= $.ajax({ url: wPromptOpts.href, async: false }).responseText;
		// Iframe
		else if(wPromptOpts.iframe && wPromptOpts.href !== null) wPromptOpts.content	= '<iframe class="wPromptIframe" name="wPromptIframe" frameborder="0" allowtransparency="true" src="' + wPromptOpts.href + '"></iframe>';
		// Function
		else if(typeof(wPromptOpts.content) == "function") wPromptOpts.content = wPromptOpts.content();
	}
	else if(typeof(data) == "function") wPromptOpts.content = data();
	else wPromptOpts.content = data;

	if(!isNaN(wPromptOpts.width)) wPromptOpts.width += "px";
	if(!isNaN(wPromptOpts.height)) wPromptOpts.height += "px";

	// onOpen
	if(typeof(wPromptOpts.onOpen) == "function") wPromptOpts.onOpen();

	// Nếu isIE6 thì không cho overlay
	if(isIE6) wPromptOpts.overlay	= false;

	html	= '';
	if(wPromptOpts.overlay) html += '<div class="wPromptOverlay"' + (wPromptOpts.overlayClose ? ' style="cursor:pointer" onClick="closeWindowPrompt()"' : '') + '></div>';
	wPromptAbsolute	= (!wPromptOpts.fixed || isIE6 ? ' wPromptAbsolute' : '');
	html += '<div class="wPrompt' + wPromptAbsolute + '">';
		html += '<div class="' + wPromptOpts.wPromptWrapper + '" style="width:' + wPromptOpts.width + '">';
         html += '<div class="title">';
         if(wPromptOpts.title !== "") html += wPromptOpts.title;
         html += '<a title="Đóng" class="close" href="javascript:;" onClick="closeWindowPrompt()"></a>';
         html += '</div>';
			html += '<div class="wPromptLoadedContent" style="width:' + wPromptOpts.width + '; height:' + wPromptOpts.height + '">';
				if(wPromptOpts.iframe && wPromptOpts.href !== null) html += wPromptOpts.content;
				else{
					cssIcon	= '';
					if(wPromptOpts.alert !== false)	cssIcon = ' wPromptAlert';
					if(wPromptOpts.confirm !== false) cssIcon = ' wPromptConfirm';
					html += '<div class="wPromptContent' + cssIcon + '">';
					html += wPromptOpts.content;
					if(wPromptOpts.alert !== false){
						html += '<div class="wPromptAlertButton"><input type="button" class="form_button" value="' + optsAlert.value + '" onClick="alertWindowPrompt()" /></div>';
					}
					if(wPromptOpts.confirm !== false){
						html += '<div class="wPromptConfirmButton">';
							html += '<input type="button" class="wPromptInputButton" value="' + optsConfirm.valueTrue + '" onClick="confirmWindowPrompt(true)" /> &nbsp;';
							html += '<input type="button" class="wPromptInputButton" value="' + optsConfirm.valueFalse + '" onClick="confirmWindowPrompt(false)" />';
						html += '</div>';
					}
					html += '</div>';
				}
			html += '</div>';
			html += '<div class="clear"></div>';
			if(wPromptOpts.showBottom){
				html += '<div class="wPromptBottom">';
					if(wPromptOpts.comment !== "") html += '<div class="wPromptComment">' + wPromptOpts.comment + '</div>';

					html += '<div class="clear"></div>';
				html += '</div>';
			}
		html += '</div>';
	html += '</div>';

	ob	= $(html);

	$("body").prepend(ob);

	ob.filter(".wPrompt").css({
		top: function(){
			offsetTop	= parseInt(($(window).height() - $(this).find(".wPromptLoadedContent").height() - 53) / 2, 10);
			if(offsetTop < 0) offsetTop = 0;
			if(!wPromptOpts.fixed || isIE6) offsetTop += $(window).scrollTop();
			return offsetTop + "px";
		},
		left: function(){
			offsetLeft	= parseInt(($(window).width() - $(this).find(".wPromptLoadedContent").width() - 42) / 2, 10);
			if(offsetLeft < 0) offsetLeft = 0;
			return offsetLeft + "px";
		}
	});

	if(wPromptOpts.width == "auto" && (isIE6 || isIE7)){
		fixW	= ob.find(".wPromptLoadedContent").width();
		ob.find(".wPromptWrapper").width(fixW);
	}

	// onComplete
	if(typeof(wPromptOpts.onComplete) == "function") wPromptOpts.onComplete(domEleWindowPrompt());

}