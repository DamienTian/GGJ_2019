/***************
 * 
 * FCK specific
 * 
 ***************/

var global = {};

var oldFramesetPageParams = {docblank:"https://loader.webspellchecker.net/spellcheck3/lf/blank.html?relaxedDomain=" ,
                             /** advertisement **/
                             thirdframeh:"140" , 
                             firstframeh:134,
                             sproxy_url:"https://loader.webspellchecker.net/spellcheck3/script/ssrv.cgi" , 
                             relaxedDomain:"" , 
                             /** newlly added **/
                             xdtiframe:"https://loader.webspellchecker.net/spellcheck3/lf/miframe.html",//url to ini frame
                             sproxy_js_frameset:"https://loader.webspellchecker.net/spellcheck3/lf/frameset.js"}; //initial result submit



/////////FCK languages syncronizer//////////////////////

function _SP_FCK_LangCompare (){
    // languages codes
    var _defLangCode = "en_US";
	var _allLang = {
        "af" : false,//"Afrikaans",
        "ar" : false,//"Arabic",
        "bg" : false,//"Bulgarian",
        "bn" : false,//"Bengali/Bangla",
        "bs" : false,//"Bosnian",
        "ca" : false,//"Catalan",
        "cs" : false,//"Czech",
        "da" : "da_DK",//"Danish",
        "de" : "de_DE",
        "el" : "el_GR",
        "en" : "en_US",
        "en-au" : false,//"English (Australia)",
        "en-ca" : "en_CA",
        "en-uk" : "en_UK",
        "eo" : false,//"Esperanto",
        "es" : false,//"sp-es",
        "et" : false,//"Estonian",
        "eu" : false,//"Basque",
        "fa" : false,//"Persian",
        "fi" : "fi_FI",
        "fo" : false,//"Faroese",
        "fr" : "fr_FR",
        "fr-ca" : "fr_CA",
        "gl" : false,//"Galician",
        "gu" : false,//"Gujarati",
        "he" : false,//"Hebrew",
        "hi" : false,//"Hindi",
        "hr" : false,//"Croatian",
        "hu" : false,//"Hungarian",
        "it" : "it_IT",
        "ja" : false,//"Japanese",
        "km" : false,//"Khmer",
        "ko" : false,//"Korean",
        "lt" : false,//"Lithuanian",
        "lv" : false,//"Latvian",
        "mn" : false,//"Mongolian",
        "ms" : false,//"Malay",
        "nb" : false,//"Norwegian Bokmal",
        "nl" : "nl_NL",
        "no" : "nb_NO",
        "pl" : false,//"Polish",
        "pt" : "pt_BR",
        "pt-br" : "pt_BR",
        "ro" : false,//"Romanian",
        "ru" : false,//"Russian",
        "sk" : false,//"Slovak",
        "sl" : false,//"Slovenian",
        "sr" : false,//"Serbian (Cyrillic)",
        "sr-latn" : false,//"Serbian (Latin)",
        "sv" : "sv_SE",//"Swedish",
        "th" : false,//"Thai",
        "tr" : false,//"Turkish",
        "uk" : false,//"Ukrainian",
        "vi" : false,//"Vietnamese",
        "zh" : false,//"Chinese Traditional",
        "zh-cn" : false//"Chinese Simplified"
    };
	
	
	
    var _getSpLang = function  (sFckCode){
        return _allLang[sFckCode] || false;
    };
    var _getFckLang = function (sSpCode){return false;};
    
    // if no match returned use getDefaulLangCode
    this.getSPLangCode = function (sSpCode){return _getSpLang(sSpCode)};
    this.getFCKLangCode = function (sFckCode){ return _getFckLang(sFckCode); };
    this.getDefaulLangCode  = function () {return _defLangCode;};
    this.setDefaulLangCode  = function (sDefCode){return _defLangCode = _getSpLang(sDefCode) || _defLangCode;};
}
/*     how to use 
LangComparer = new _SP_FCK_LangCompare();
if (!LangComparer && _SP_FCK_LangCompare)
{
    LangComparer = new _SP_FCK_LangCompare();
}
 
LangComparer.getSPLangCode(oEditor.FCK.Language.GetActiveLanguage())
LangComparer.setDefaulLangCode(oEditor.FCK.Language)
console.info(oEditor.FCK.Language.DefaultLanguage)     

*/
////////////END FCK languages syncronizer//////////////////////

if (typeof CKEDITOR === "object") {
    CKEDITOR.config = CKEDITOR.config || {};

    if (CKEDITOR.config.wsc_removeGlobalVariable) {
        CKEDITOR.config.wsc = {};
        CKEDITOR.config.wsc.DefaultParams = {
            serviceHost : "https://loader.webspellchecker.net/spellcheck3" + '/',
            scriptPath : 'lf/23/unpacked_js/spell.js',
            ssrvHost    : '/script/ssrv.cgi',
            logoPath     : "https://loader.webspellchecker.net/spellcheck3" + '/lf/23/img/powered_by.gif',
            iconPath     : "https://loader.webspellchecker.net/spellcheck3" + '/lf/23/img/progress.gif',
            iconPathEmptyEditor     : "https://loader.webspellchecker.net/spellcheck3" + '/lf/23/img/progressText.png',
            _SP_FCK_LangCompare: _SP_FCK_LangCompare
        };
    } else {
         DefaultParams = {
            serviceHost : "https://loader.webspellchecker.net/spellcheck3" + '/',
            scriptPath : 'lf/23/unpacked_js/spell.js',
            ssrvHost    : '/script/ssrv.cgi',
            logoPath     : "https://loader.webspellchecker.net/spellcheck3" + '/lf/23/img/powered_by.gif',
            iconPath     : "https://loader.webspellchecker.net/spellcheck3" + '/lf/23/img/progress.gif',
            iconPathEmptyEditor     : "https://loader.webspellchecker.net/spellcheck3" + '/lf/23/img/progressText.png',
            _SP_FCK_LangCompare: _SP_FCK_LangCompare
        };
    };
    
};

function doLoadScript (url) {   if (!url) return;           var h = document.getElementsByTagName('head')[0];           var s = document.createElement('script');           s.type = 'text/javascript' ;            s.src  = url ;          h.appendChild(s);           return true;        }




global.iframePath = null; 
function initIframeTransport(oWindow){
	
	
    var pName = gFCKPluginName || 'WSC';
    oWindow.XDTMaster.init({
        xdtSelfUrl: global.iframePath || oEditor.FCKPlugins.Items[pName].Path+'ciframe.html',
        xdtClientUrl: oldFramesetPageParams.xdtiframe,
        // on Recieve spelled data callback
        onFinish: function(m){
            //console.info(" master callback burned with data [[ %s ", m);
            endSpellCheckCallbackInvoker('finish', ctrlName, m);
            //TODO: close session on ssrv
            //spellWin.window.close();
        },
        onCancel: function(m){
            //TODO: close session on ssrv
            //spellWin.window.close();
            endSpellCheckCallbackInvoker('cancel', ctrlName, m);
        }
    });
    
}


// #27322
var browser = (function() {
    var _ua = window.navigator.userAgent;
    var versionAndName = (function() {
        var ua　= _ua, tem,
            M　= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*([\d\.]+)/i) || [];
        
        if(/trident/i.test(M[1])) {
            tem =  /\brv[ :]+(\d+(\.\d+)?)/g.exec(ua) || [];
            //return 'IE '+(tem[1] || '');
            return {
                name: 'IE ',
                version: (tem[1] || '')
            };
        }
        
        M　= M[2]　? [M[1], M[2]]　:　[navigator.appName, navigator.appVersion, '-?'];
        tem　= ua.match(/version\/([\.\d]+)/i);
        
        if(tem　!= null) {
            M[2] = tem[1];
        }
        // M.join(' ')
        return {
            name: M[0],
            version: M[1]
        };
    })();
    return {
        name: versionAndName.name,
        version: versionAndName.version,
        isOpera: (/opera/i.test(_ua) || /opr/i.test(_ua)),
        isMsie: (/msie/i.test(_ua) && !/opera/i.test(_ua) || /trident\//i.test(_ua)),
        isMsie6: (/msie 6/i.test(_ua) && !/opera/i.test(_ua)),
        isMsie7: (/msie 7/i.test(_ua) && !/opera/i.test(_ua)),
        isMsie8: (/msie 8/i.test(_ua) && !/opera/i.test(_ua)),
        isMsie9: (/msie 9/i.test(_ua) && !/opera/i.test(_ua)),
        isMozilla: /firefox/i.test(_ua),
        isChrome: /chrome/i.test(_ua),
        isSafari: (!(/chrome/i.test(_ua)) && /webkit|safari|khtml/i.test(_ua)),
        isIphone: /iphone/i.test(_ua),
        isIpod: /ipod/i.test(_ua),
        isIphone4: /iphone.*OS 4/i.test(_ua),
        isIpod4: /ipod.*OS 4/i.test(_ua),
        isIpad: /ipad/i.test(_ua),
        isAndroid: /android/i.test(_ua),
        isBada: /bada/i.test(_ua),
        isMobile: /iphone|ipod|ipad|opera mini|opera mobi|iemobile|android/i.test(_ua),
        isMsieMobile: /iemobile/i.test(_ua),
        isSafariMobile: /iphone|ipod|ipad/i.test(_ua),
        isOperaMobile: /opera mini|opera mobi/i.test(_ua),
        isOperaMini: /opera mini/i.test(_ua),
        isMac: /mac/i.test(_ua)
    }
}());

/****************
 * 
 * WCS core
 * 
 ***************/


// run WSC 
function doStartSpell (oParams){
   return doSpell(oParams);
}

var isRfamesetPageStatic = true;
var isUseRecursiveFrames = false;
// (c)2000-2008 SpellChecker.net,Inc.  All rights reserved.  www.SpellChecker.net
var spchver="";


var sp_sh="https://loader.webspellchecker.net/spellcheck3";
var schema_url="";
var schema="22";
var spp_langs="";
/*
 * sproxy url must be the same as client url
 */
var url="https://loader.webspellchecker.net/spellcheck3/script/ssrv.cgi";

var service_host=sp_sh;
var customerid="1:ua3xw1-2XyGJ3-GWruD3-6OFNT1-oXcuB1-nR6Bp4-hgQHc-EcYng3-sdRXG3-NOfFk";
var cust_dic_ids="";
var udn="";
/*~var hide="";*/
var doc_blank="/lf/blank.html";
var doc_initialize = url+"?cmd=script&doc=wsc_core&name=initialize";
var doc_blankform="/lf/blankform.html";
var doc_process="/script/ssrv.cgi";
var is_window_opened=false; 
var formNum=-1;
var ctrlName='';

// #27322
var isMSIE = browser.isMsie;
var isNN=navigator.appName=='Netscape';
var isProxyVer=false;
var botf,cmd,spellWin,ssrv_host,port,ssrv,ssrvname,lang,ctrl,url,force_reload,intlang,ctrlObj,sp_i,sp_doc,sp_time,sp_old_doc_unload,sp_spw_name,sp_spw_params,sp_wurl,sp_asce,sp_iswopn;
var sRelaxedDomain = "";
var sReferer = document.location.href;
var onCancel = null;
var onFinish = null;
var onClose = null;
var windowTitle = "SpellChecker.net";
var tabsConfig = {};
var operaCrossDomain = false;

var isCallbackInvokedInSession = false;
// load config from old frameset page

/**
* API Function 
* @param {Object} oParams  
* object params:
*   oParams.lang {String} one of allowed lang names
*   oParams.ctrl {Mixed} control id or array of ids
*   oParams.forceReload
*   oParams.intLang {String} - interface language @see oParams.lang
*   oParams.userDictionaryName {String} - fixed dictionary name
*   oParams.customDictionaryName {Array} - additional custom (customer) dictionary identifiers array
*   oParams.schemaIdentifier {int} - schema identifier
*   oParams.isProxyVer {Boolean} - 
*   oParams.width {int} - window width
*   oParams.height {int} - window height
*   oParams.top {int} - window initial y coortinate
*   oParams.left {int} - window initial x coortinate
*   oParams.title {String} - window title
*   oParams.domainName {String} - common domain name (relaxed script solution)
*   oParams.schemaURI{String} - custom CSS url ("")
*   oParams.onCancel {Function} - Callback function
*   oParams.onFinish {Function} - Callback function
*   oParams.onClose {Function} - Callback function
*	oParams.tabsConfig - tabs to shown (example)
*/

function doSpell(oParams){
    
    if(typeof(oParams) != 'object' || !oParams.ctrl){
        alert('Wrong initial data');
        return;
    }
    //relaxed scripting solution
    if(typeof(oParams.domainName) == "string" && (/^\s*$/).test(oParams.domainName) == false){
        sRelaxedDomain = oParams.domainName
        document.domain = sRelaxedDomain;
    }
    mSourceCtrlsNames = oParams.ctrl;
    sStaticFramesetPage = oParams.staticFrame || 'tmpFrameset.html' ;
    global.iframePath = oParams.iframePath || null;
	
	if(oParams.tabsConfig)
	{
		tabsConfig = oParams.tabsConfig		
	}
	else
	{
		tabsConfig = "1,1,1,1";		
	}
	
    if (oParams.ctrl && typeof oParams.ctrl == "object" && oParams.ctrl.length){        
        spellCheckMultipleInstances(oParams.ctrl, oParams.lang);
    }else{
        spellCheckSingleInstance(oParams);
    }
}


function spellCheckSingleInstance(oParams){
    
    // #27322
    // If your browser is Microsoft Internet Explorer version 5 
    // and below or you use Safari version 3. 
    // You will see message with warning.
    if((isMSIE && (parseInt(browser.version, 10) <= 5)) || (isNN && (parseInt(browser.version, 10) === 3) && !browser.isSafari)) {
        alert('Sorry, currently we do not support your browser.');
        return;
    }  

    lang = oParams.lang || "en_US";
    cmd = oParams.cmd || "spell";
    ctrl = oParams.ctrl || null;
    force_reload = (oParams.forceReload != null)?oParams.forceReload:(true);  
    intlang = oParams.intLang || "";
    /*~hide = oParams.hide || "";   */
    isProxyVer = (oParams.isProxyVer != null)?(oParams.isProxyVer):isProxyVer;
    udn = oParams.userDictionaryName || udn;
    cust_dic_ids = oParams.customDictionaryName || cust_dic_ids;
    if(cust_dic_ids.constructor &&  cust_dic_ids.constructor.toString().toLowerCase().indexOf("array") != -1){
        cust_dic_ids = cust_dic_ids.join(',');
    }
    
    schema = oParams.schemaIdentifier || schema;
    schema_url = oParams.schemaURI || schema_url;
    operaCrossDomain = oParams.operaCrossDomain ? 1 : 0;

    onCancel = oParams.onCancel || onCancel;
    onFinish = oParams.onFinish || onFinish;
    onClose = oParams.onClose || onClose;
    
    

    var wWidth = (parseInt(oParams.width)>0)?(oParams.width):(492);
    var wHeight = (parseInt(oParams.height)>0)?(oParams.height):(440);
    
    var wTop = (parseInt(oParams.top)>=0)?(oParams.top):(null);
    var wLeft = (parseInt(oParams.left)>=0)?(oParams.left):(null);
    windowTitle = oParams.title || windowTitle;
    

    if(ctrl.id=="MTBDummy"){
        ctrlName = ctrl.id;
        ctrlObj = ctrl;
    }else{
        var nObj = document.getElementById(ctrl);
    
        if(nObj == null){
            alert('Source element "' + ctrl + '" not found');       
            return;
        }else{
            ctrlName = ctrl;
            ctrlObj = nObj;
        }
    }
    
    if(/^\s*$/.test(getSourceObjectContent(ctrlObj,true))){
        alert('Nothing to check.');
        return;
    }
    
    sp_time = "";

    if(isProxyVer){
        if(service_host==sp_sh){

            if((/:\/\/(.*?)\//).test(service_host)){
                ssrv_host = RegExp.$1
            }else{
                ssrv_host = '';
            }
            /*~}*/
            (/(^.*\/)(.*)/).test(url);  
            service_host = RegExp.$1;
            ssrvname = RegExp.$2;
        }
        doc_blank=ssrvname+"?cmd=script&doc=wsc_core&name=blank&ssrv_host="+ssrv_host;
        doc_blankform=ssrvname+"?cmd=script&doc=wsc_core&name=blankform&ssrv_host="+ssrv_host;
        doc_process=ssrvname;
    } else {
        ssrv_host='';
        port='';
        ssrv='';
        ssrvname='';
    }
    
    if(is_window_opened){
        is_window_opened = false;
    }
    

    botf=167;
        
    if(window.name==''){
        window.name='sp_ch_opener_window';
    }
    
    wndname=window.name;
        
    if (!is_window_opened) {
    
        sp_wurl = getWindowURL();
        isCallbackInvokedInSession = false;
        
        
        if (typeof(oParams.winType) == 'undefined') {
		      throw "Iframe id is required";
		}
		try{
			 spellWin = window[oParams.winType];
             _spellWin = document.getElementById(oParams.winType);
             _spellWin.src = sStaticFramesetPage;
             spellWin.location.href = sStaticFramesetPage;
		}catch(ex){}
        
        spellWin.opener = window;
		
        //console.info("check it %o",spellWin);
        var buildFramesetPage = function(){
            //spellWin.opener = window;
            
            if (typeof(oldFramesetPageParams) != 'undefined' && !isRfamesetPageStatic) {
                with (spellWin) {
                    document.open();
                    document.write('<html><head> <title>Foo Title</title>');
                    document.write('<script>');
                    document.write('function doLoadScript (url) { if (!url) return; var h = document.getElementsByTagName("head")[0]; var s = document.createElement("script"); s.type = "text/javascript" ; s.src  = url ; h.appendChild(s); return true;};');
                    document.write('doLoadScript("' + oldFramesetPageParams.sproxy_js_frameset + '");');
                    document.write('</script>');
                    document.write('</head>');
                    document.write('<frameset rows="' + oldFramesetPageParams.firstframeh + ',*,*,0" frameborder="no" framespacing="0" border="0" onLoad="doLoad()" ><frame name="navbar" src="' + oldFramesetPageParams.docblank + '" marginwidth="2" marginheight="0" noresize scrolling="no" frameborder="no" framespacing="0" /> <frame name="mid" src="" marginwidth="0" marginheight="0" noresize="noresize" scrolling="auto" frameborder="no" framespacing="0" /> <frame name="bot" src="' + oldFramesetPageParams.docblank + '" marginwidth="1" marginheight="1" noresize="noresize" scrolling="auto" frameborder="no" framespacing="0" /> <frame name="spellsuggestall" src="' + oldFramesetPageParams.docblank + '" marginwidth="1" marginheight="1" noresize="noresize" scrolling="no" frameborder="no" framespacing="0" />');
                    document.write('</html>');
                    document.close();
                }
            }else {
                /*  addSrcipt() temporary deprecated  */
                    
                // include js to static frameset page
                //spellWin.document.write('<script type="text/javascript" src="' + oldFramesetPageParams.sproxy_js_frameset + '"></script>');
                var addSrcipt = function (){
                    // emulate opener variable
                    //this.contentWindow.opener = window;
                    try{
                    
                            var oWindow = _chooseWindowObj(oParams);
                            if (typeof(this.contentWindow) != 'undefined') oWindow=this.contentWindow;
                            oWindow.fakeOpener = window;
                            /*var s = oWindow.document.createElement('script');
                            s.src = oldFramesetPageParams.sproxy_js_frameset;
                            var h = oWindow.document.getElementsByTagName("head")[0];
                            h.appendChild(s);*/
                    }catch(e){
                        alert(e.message);
                    }
                }
                    
                if (isMSIE) {
                    
                    addSrcipt();
                }
                     
                else{
                    _chooseWindowObj(oParams).onload = addSrcipt;
                }
                
            }
        }
        if (!spellWin) {
            window.setTimeout(buildFramesetPage, 500);
        }
        else {
            buildFramesetPage();
        }
        
    }
    spellWin.focus();	
    return;
}
               
                        
function _chooseWindowObj (oParams){
    /*if (typeof(oParams.winType)!='undefined') alert("_spellWin choosed")
    else alert("spellWIn choosed")*/
    return typeof(oParams.winType)!='undefined'
           ? _spellWin
           : spellWin;
}

function obj2QueryString (o, sPrefix){
    
    if (!o) return ;
    var _pre = sPrefix || 'pre_';
    var _sQuery = '';
    var _amp = '';
    for (var n in o){
        _sQuery +=  _amp + _pre+n + '=' + o[n];
        if (!_amp) _amp = '&';
    }
    return _sQuery;
    
    //opener.getSpellFormData()
}

function initWSCFrames(){
    
    spellWin.location.replace(getSPWU());
    return;
}

function getSPWU(){
    var sBlankDocUrl = escape(addUrlParam((service_host+doc_blank),"relaxedDomain",sRelaxedDomain));
    var sBlankFormDocUrl = escape(addUrlParam((service_host+doc_blankform),"relaxedDomain",sRelaxedDomain));
    /*~return url+'?cmd=script&doc=wsc_core&name=frm&qw=&ctrlname=&firstframeh=30&thirdframeh='+botf+'&fifthframe=&docblank='+sBlankDocUrl+'&docblankform='+sBlankFormDocUrl+'&hide='+hide + '&relaxedDomain=' + (sRelaxedDomain?sRelaxedDomain:'');*/
    return url+'?cmd=script&doc=wsc_core&name=frm&qw=&ctrlname=&firstframeh=30&thirdframeh='+botf+'&fifthframe=&docblank='+sBlankDocUrl+'&docblankform='+sBlankFormDocUrl+'&relaxedDomain=' + (sRelaxedDomain?sRelaxedDomain:'');
}

function ChkFrm(oForm) {
    sp_doc=oForm.document || spellWin.frames[1].document;
    
    if(sp_doc) { 
        var f_dst;		
		
        f_dst=sp_doc.forms[0];
        if (!f_dst) return false;
        f_dst.action=service_host+doc_process;
        if(sp_asce){
            f_dst.sp_asce.value=lang;
        }
        f_dst.cmd.value=cmd;
        f_dst.slang.value=lang;
        f_dst.intlang.value=intlang;
        f_dst.text.value=getSourceObjectContent(ctrlObj,false);
        f_dst.trg_url.value=url;
        f_dst.trg_wnd.value=wndname;
        f_dst.txt_ctrl.value=force_reload?ctrlName:'';
        f_dst.svc_time.value=(new Date()).getTime();
        f_dst.customerid.value=customerid?customerid:'';
        f_dst.cust_dic_ids.value=cust_dic_ids?cust_dic_ids:'';
        f_dst.udn.value=udn?udn:'';
        f_dst.operaCrossDomain.value=operaCrossDomain;
        f_dst.schema_url.value=schema_url;
        f_dst.schema.value=schema;
        f_dst.spp_langs.value=spp_langs;
    /*~ f_dst.hide.value=hide;*/
        f_dst.settings.value=(isProxyVer)?("sproxy"):("sproxy=0");
        if(f_dst.ssrv_host){
            f_dst.ssrv_host.value=ssrv_host;
        }
        f_dst.relaxedDomain.value = sRelaxedDomain;
        f_dst.referer.value = sReferer;
		
		if(f_dst.tabs_config)
		{
			f_dst.tabs_config.value = tabsConfig;
		}
		
		f_dst.submit();
		
    }else{
    }
    is_window_opened=true;
}
function getSpellFormData (){
        
        var f_dst={};
        
        f_dst.action=service_host+doc_process;
        if(sp_asce){
            f_dst.sp_asce =lang;
        }
        f_dst.cmd = cmd;
        f_dst.slang =lang;
        f_dst.intlang =intlang;
        f_dst.text =getSourceObjectContent(ctrlObj,false);
        f_dst.trg_url =url;
        f_dst.trg_wnd =wndname;
        f_dst.txt_ctrl =force_reload?ctrlName:'';
        f_dst.svc_time =(new Date()).getTime();
        f_dst.customerid =customerid?customerid:'';
        f_dst.cust_dic_ids =cust_dic_ids?cust_dic_ids:'';
        f_dst.udn =udn?udn:'';

        f_dst.schema_url =schema_url;
        f_dst.schema =schema;
        f_dst.spp_langs =spp_langs;
        f_dst.settings =(isProxyVer)?("sproxy"):("sproxy=0");
        f_dst.ssrv_host =ssrv_host;
        f_dst.relaxedDomain  = sRelaxedDomain;
		f_dst.referer  = sReferer;
        
        return f_dst;
}


function getWindowURL(){
    var sUrl = doc_initialize;
    sUrl = addUrlParam(sUrl,"relaxedDomain",sRelaxedDomain);
    return sUrl;
}

function addUrlParam(sUrl,sParam,sValue){
    return sUrl + ((/\?/).test(sUrl)?("&"):("?")) + sParam+ "=" + sValue; 
}

function isAppVer(s){
    return navigator.appVersion.indexOf(s)!=-1;
}


//# callback method invoker
function endSpellCheckCallback(sExitType,sCtrlId,sCheckedContent){
    //console.info("callBack invoked [[ %s,  %s,  %o", sExitType,sCtrlId,sCheckedContent)
    var mCtrl = null;
    if(isCallbackInvokedInSession == true){
        return;
    }
    isCallbackInvokedInSession = true;
    
    if(sCtrlId == "MTBDummy"){
        mCtrl = pChecker.getCtrls();
    }else{
        mCtrl = document.getElementById(sCtrlId);
    }
    switch(sExitType){
        case "cancel":
            if(typeof(onCancel) == 'function'){
                onCancel(mCtrl);
            }
        break;
        case "close":
            
            if(typeof(onClose) == 'function'){
                onClose(mCtrl);
            }
        break;      
        case "finish":
            if(sCtrlId == "MTBDummy"){
                pChecker.restore(sCheckedContent);
            }else{
                setSourceObjectContent(mCtrl,sCheckedContent);
            }
            
            if(typeof(onFinish) == 'function'){
                onFinish(mCtrl);
            }
        break;      
    }
}


//#get node content
function getSourceObjectContent(nObject,isText){
    var sContent = '';
    var nCtrl = null;
    
    if(nObject.value)
    {
        sContent = nObject.value;
    } else if(nObject.contentWindow)
    {
        nCtrl = nObject.contentWindow.document.body;
    } else if (nObject.contentEditable &&
        (nObject.tagName == "SPAN" || 
        nObject.tagName == "DIV"))
    {
        nCtrl = nObject; 
    }
    if (nCtrl) {
        if(isText){
            sContent = nCtrl.innerText ||
            nCtrl.textContent ||
            "";
        }else{
            sContent = nCtrl.innerHTML;
        }
    }
    return sContent;
}
//# set Source object content
function setSourceObjectContent(nObject,sContent){
    if(nObject.value){
        nObject.value = sContent;
    }else if(nObject.contentWindow){
        nObject.contentWindow.document.body.innerHTML = sContent;
    } else if (nObject.contentEditable &&
        (nObject.tagName == "SPAN" || 
        nObject.tagName == "DIV"))
    {
        nObject.innerHTML = sContent;
    }
    return;
}

//#convert incoming string to identifier valid format: knife.domain.com:8080 => knife_domain_com_8080
function createIdentifier(sValue){
    return sValue.replace(/(\.|\-|\:)/img,'_');
}
//multiple instances  addon

/////////////////////////////////////////////////////////////////////////////////////////
var pChecker = null;
function MTB_I_Make_RegExp(strName)
{
    return new RegExp(strName.replace(/%/g, '\\x').replace(/\+/g, ' ').replace(/\*/g, '\\*').replace(/\[/g, '\\[').replace(/\]/g, '\\]'), '');
}

function MTB_I_EscapeText(strSrc)
{
    return strSrc.replace(/&/g,'&amp;').replace(/</g,'&lt;');
}

function MTB_I_UnescapeText(strSrc)
{
    return strSrc.replace(/&lt;/g, '<').replace(/&amp;/g, '&');
}
/////////////////////////////////////////////////////////////////////////////////////////
function MTB_I_StdAction(strText)
{
    this.obj.restore(strText);
}
function MTB_I_DummyObj()
{
    this.value  = '';
    this.name   = 'MTB_Dummy.action(this.document.forms[0].msg_body.value), parent.opener.MTB_Dummy';
    this.obj    = null;
    this.id = 'MTBDummy';
}
MTB_I_DummyObj.prototype.action = MTB_I_StdAction;
var MTB_Dummy   = new MTB_I_DummyObj();
/////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
function MTB_I_Compose_Text(bSimple){

    var strResult;
    var i,j;
    var count   = 0;

    if (bSimple){
        strResult   = '';
    }else{
        strResult   = this.m_strBegin;
    }
    //var items = this.m_strNames.split(',');
   // var s = ''; s1 = '';
    var i, j;
    var items = this.m_strNames;
    
    for (i = 0; i < items.length; i++)
    {
        //var ctrl = eval(items[i]);
        var s_ctrl = items[i];
        var nObj = document.getElementById(items[i]);
        if(!nObj){
            continue;
        }
        var s_val = getSourceObjectContent(nObj,false);

        if (!bSimple)
            strResult   += this.m_strRBegin + '_x_path="' + s_ctrl + '"' + this.m_strRMiddle;
        strResult       += s_val;
        if (!bSimple)   
            strResult   += this.m_strREnd;
        else
            strResult   += this.m_strSDiv;
        count++;
        
        //s += items[i] + "\n";
    }

    if (!bSimple){
        strResult   += this.m_strEnd;
    }

    return strResult;
}
/////////////////////////////////////////////////////////////////////////////////////////
function MTB_I_Restore(strValue)
{
    var aE  = MTB_I_UnescapeText(strValue).split(this.m_strSplitter);
    var i;
    var sPath;
    var nBeg,nEnd;
    
    for (i = 0; i < aE.length - 1; i++)
    {
        nBeg                = aE[i].indexOf('_x_path="') + '_x_path="'.length;
        nEnd                = aE[i].indexOf('"' + this.m_strRMiddle, nBeg);
        sPath               = aE[i].substring(nBeg, nEnd);

        setSourceObjectContent(document.getElementById(sPath),aE[i].substring(nEnd + this.m_strRMiddle.length + 1, aE[i].length));

    }
}
/////////////////////////////////////////////////////////////////////////////////////////
function MTB_I_Check()
{
    MTB_Dummy.value     = this.compose(false);
    MTB_Dummy.obj       = this;


    if (MTB_Dummy.value == (this.m_strBegin + this.m_strEnd)){
        alert('Nothing to check');
    }else{
        spellCheckSingleInstance({ctrl:MTB_Dummy,lang:this.m_strLang});
    }
}
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
function MTBChecker(strNames, strLang)
{
    this.m_strNames = strNames;
    this.m_strLang  = strLang;
}

MTBChecker.prototype.check      = MTB_I_Check;
MTBChecker.prototype.compose    = MTB_I_Compose_Text;
MTBChecker.prototype.restore    = MTB_I_Restore;
MTBChecker.prototype.getCtrls = function(){
    var ctrls = new Array();
    for(var i=0; i<this.m_strNames.length;i++){
        ctrls.push(document.getElementById(this.m_strNames[i]));
    }
    return ctrls;
}

MTBChecker.prototype.m_strBegin     = '<table border=1 _bordercolor=silver width=100%>';
MTBChecker.prototype.m_strEnd       = '</table>';
MTBChecker.prototype.m_strRBegin    = '<TR tr_x_tr><TD ';
MTBChecker.prototype.m_strRMiddle   = '>';
MTBChecker.prototype.m_strREnd      = '</TD tr_x_tr></TR tr_x_tr>';
MTBChecker.prototype.m_strSplitter  = "</TD tr_x_tr></TR tr_x_tr>";
MTBChecker.prototype.m_strSDiv      = '\n\n';

MTBChecker.prototype.m_strDoc           = 'document';
MTBChecker.prototype.m_strCollection    = 'forms';
MTBChecker.prototype.m_strSubCollection = 'elements';
MTBChecker.prototype.m_strTypes         = 'text,textarea';

MTBChecker.prototype.m_objSubmitForm = "";

function spellCheckMultipleInstances(strNames, strLang){
    pChecker    = new MTBChecker(strNames, strLang);
    pChecker.check();
}




/*intended for onEndSpellCheck invoking (callback interface)*/
//var isAlreadyObey = false;
function endSpellCheckCallbackInvoker(sExitType,sCtrlId,sCheckedText){
    switch(sExitType){
        case "cancel":
           endSpellCheckCallback(sExitType,sCtrlId,sCheckedText);
           break;
        case "close":
           break;
        case "finish":
            endSpellCheckCallback(sExitType,sCtrlId,sCheckedText);
           break;
    }
}
