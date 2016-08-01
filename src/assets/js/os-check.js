(function() {
	var csstype = 'external', // specify type of CSS to use. "inline" or "external"
		mac_css = '', // if 'inline', specify mac css here
		pc_css = '', // if 'inline', specify PC/default css here

		mac_externalcss = '//' + document.location.host + '/assets/css/macstyle.css', // if "external", specify Mac css file here
		pc_externalcss = '//' + document.location.host + '/assets/css/windowstyle.css', // if "external", specify PC/default css file here
		mactest = navigator.userAgent.indexOf('Mac') != -1,
		head = document.getElementsByTagName('head')[0],
		css_tag,
		text_node;

	if (csstype == 'inline') {
		text_node = document.createTextNode(mactest ? mac_css : pc_css);

		css_tag = document.createElement('style');
		css_tag.type = 'text/css';
		css_tag.appendChild(text_node);
	} else {
		css_tag = document.createElement('link');
		css_tag.type = 'text/css';
	  	css_tag.rel = 'stylesheet';
	  	if (navigator.appVersion.indexOf("Win")!=-1){
	  		css_tag.href = pc_externalcss;	
	  	}else if(mactest){
	  		css_tag.href = mac_externalcss;	
	  	}
	}

	head.appendChild(css_tag);
})();
