/* written by Dream'dev 2015*/

	var proto = HTMLElement.prototype ;


	proto.css = function(styl,delay,handler){
		var top = this ;
		if(typeof styl==='object'){
			setTimeout(function(){
				for(var prop in styl){
					if(getComputedStyle(top,null)[prop]!=(null && false)){
						top.style[prop] = styl[prop] ;
					}
					else{
						console.log('undefined property '+prop) ;
					}
				}
				if(handler) handler() ;
			},delay||0) ;
			return top ;
		}
		else if(typeof styl==='string'){
			setTimeout(function(){
			},delay||0) ;
			return getComputedStyle(top,null)[styl] ;
		}
	} ;


	/* cette methode permet de reccuperer ou d'assigner une largeur à un élement */
	proto._width = function(val,delay){
		var top = this ;
		setTimeout(function(){
			if(val) top.css({width:(typeof val=='number') ? val+'px' : val}) ;
		},delay||0) ;
		return (val) ? top : top.offsetWidth ;
	} ;


	/* cette methode permet de reccuperer ou d'assigner une hauteur à un élement */
	proto._height = function(val,delay){
		var top = this ;
		setTimeout(function(){
			if(val) top.css({height:(typeof val=='number') ? val+'px' : val}) ;
		},delay||0) ;
		return (val) ? top : top.offsetHeight ;
	} ;

	proto._left = function(val,delay){
		var top = this, ret ;

		setTimeout(function(){
			if(val){
				ret = top ;
				if(top.css('position')=='absolute' || top.css('position')=='fixed'){
					top.css({left:(typeof val=='number') ? val+'px' : val}) ;
				}else{
					top.css({marginLeft:(typeof val=='number') ? val+'px' : val}) ;
				}
			}
		},delay||0) ;

		if(!val){
			ret = (top.css('position')=='absolute' || top.css('position')=='fixed') ? top.css('left').split('p')[0] : top.css('marginLeft').split('p')[0] ;
		}
		else ret = top ;

		return ret ;
	} ;

	proto._top = function(val,delay){
		var top = this, ret ;

		setTimeout(function(){
			if(val){
				ret = top ;
				if(top.css('position')=='absolute' || top.css('position')=='fixed'){
					top.css({top:(typeof val=='number') ? val+'px' : val}) ;
				}else{
					top.css({marginTop:(typeof val=='number') ? val+'px' : val}) ;
				}
			}
		},delay||0) ;

		if(!val){
			ret = (top.css('position')=='absolute' || top.css('position')=='fixed') ? top.css('top').split('p')[0] : top.css('marginTop').split('p')[0] ;
		}
		else ret = top ;
		
		return ret ;
	} ;
	

	proto.centerX = function(delay){ // element have to be absolute on his parent
		var top = this ;
		var exec = function(){
			if(top.css('position')=='absolute'){
				var lefts = (top.parentNode.offsetWidth/2) - (top.offsetWidth/2) +'px' ;
				top.css({'left':lefts}) ;
			}
			else{
				var lefts = (top.parentNode.offsetWidth/2) - (top.offsetWidth/2) +'px' ;
				top.parentNode.css({'paddingLeft':lefts}) ;
			}
		} ;

		if(delay){
			setTimeout(function(){
				exec() ;
			},delay||0) ;
		}else
			exec() ;

		return top ;
	} ;
	
	proto.centerY = function(delay){ // element have to be absolute on his parent
		var top = this ;
		var exec = function(){
			if(top.css('position')=='absolute'){
				var tops = (top.parentNode.offsetHeight/2) - (top.offsetHeight/2) +'px' ;
				top.css({'top':tops}) ;
			}
			else{
				var tops = (top.parentNode.offsetHeight/2) - (top.offsetHeight/2) +'px' ;
				top.parentNode.css({'paddingTop':tops}) ;
			}
		} ;

		if(delay){
			setTimeout(function(){
				exec() ;
			},delay||0) ;
		}
		else
			exec() ;
		
		return top ;
	} ;
	
	proto.centerXY = function(delay){ // element have to be absolute on his parent
		var ti = this ;
		setTimeout(function(){
			ti.centerX().centerY() ;
		},delay||0) ;
		return ti ;
	} ;
	
	proto._hide = function(delay){
		var top = this ;
		setTimeout(function(){
			top.css({'display':'none'}) ;
		},delay||0) ;
		return this ;
	} ;
	
	proto._show = function(delay){
		var top = this ;
		setTimeout(function(){
			top.css({'display':'inherit'}) ;
		},delay||0) ;
		return this ;
	} ;
	
	proto.addto = function(parent,delay){
		var top = this ;
		setTimeout(function(){
			parent.appendChild(top) ;
		},delay||0) ;
		return top ;
	} ;
	
	proto._before = function(target,delay){
		var top = this ;
		setTimeout(function(){
			target.parentNode.insertBefore(top,target) ;
		},delay||0) ;
		return top ;
	} ;
	
	proto._after = function(target,delay){
		var top = this ;
		setTimeout(function(){
			if(target.nextSibling)
				target.parentNode.insertBefore(top,target.nextSibling) ;
			else
				target.parentNode.appendChild(top) ;
		},delay||0) ;
		return top ;
	} ;
	
	proto._remove = function(delay,handler){
		var top = this ;
		setTimeout(function(){
			top.parentNode.removeChild(top) ;
			top = false ;
			if(handler) handler() ;
		},delay||0) ;
		return (!top)?true:false ;
	} ;
	
	proto.attr = function(attributes){
		if(typeof attributes === 'object'){ 
			for(var at in attributes){
				
					this.setAttribute(at,attributes[at]) ;
		
				if(attributes[at].length==0){
					this.removeAttribute(at) ;
				}
			}
			return this ;
		}
		else if(typeof attributes === 'string'){
			return this.getAttribute(attributes) ;
		}
	} ;

	proto.adclax = function(className,delay){
		var top = this ;

		var _apply = function(){
			if(top.className.length<=1){
				top.className = className ;
			}
			else{
				var classes = top.className ;
				if(classes.trim().split(' ').length>1){
					classes = classes.trim().split(' ') ;
					var new_class = '' ;
					for(var i=0; i<classes.length; i++){
						if(classes[i].trim().length>0) new_class += ' '+classes[i] ;
					}
					new_class += ' '+className ;
					top.className = new_class.trim() ;
				}
				else if(classes.trim().split(' ').length==1){
					top.className = classes.trim() + ' '+ className ;
				}
			}
		} ;

		if(delay){
			setTimeout(function(){
				_apply() ;
			},delay||0) ;
		}
		else{
			_apply() ;
		}

		return top ;
	} ;

	proto.removeclax = function(className,delay){
		var top = this ;
		setTimeout(function(){
			var classes = top.className ;
			if(classes.trim().split(' ').length==1 && classes.trim()==className) top.attr({'class':''}) ;
			else if(classes.trim().split(' ').length>1){
				classes = classes.trim().split(' ') ;
				var count = 0 ; // count matches
				for(var i=0; i<classes.length; i++){
					if(classes[i].trim()==className){
						classes[i] = '' ;
						count++ ;
					}
				}

				if(count==0) console.error('la classe que vous essayez de retirer n\'est pas définie.') ;
				else {
					top.className = classes.join(' ') ;
					top.className = top.className.trim() ;
				}
			}
		},delay||0) ;
		return top ;
	} ;

	/*
	* Cette methode permettra de verifier si l'objet sur lequel elle est appliquée
	* a la classe "classeName" passée en paramètre
	* USAGE : elHtml.hasclax(classeAverifier) ;
			  retourne vrai si l'élément a bien la classe
			  retourne faux si l'élément n'a pas la classe
	*/
	proto.hasclax = function(className){
		var top = this, has = false ;
			var classes = top.className.split(' ') ;
			for(var i=0; i<classes.length; i++){
				if(className==classes[i].trim()){
					has = true ;
					break ;
				}
			}
		return has ;
	} ;


	/*
	* Cette methode permettra de verifier :
	*	- soit si l'élement à un ou des éléments enfants
	*	- soir si l'élément à un ou plusieurs éléments enfants dont qui peuvent être identifiés par le paramètre rensigné.
	*/

	proto.haschild = function(val){
		var top = this, res = false ;
		if(!val){
			for(var i=0; i<top.childNodes.length; i++){
				if(top.childNodes[i].nodeName != '#text'){ res = true; break; }
			}
		}
		else{
			top.adclax('_searching_on_this_now') ;
			if(_('._searching_on_this_now > '+val)) res = true ;
		}

		return res ;
	} ;

	/* Cette methode ne concerne pas les tableau
	*  permettant d'echapper l'utilisation de la boucle for
	*/

	Object.prototype.each = function(handle,delay){
		var top = this ;
		setTimeout(function(){
			for(var i=0; i<top.length; i++){
				if(handle) handle(top[i],i) ;
			}
		},delay||0) ;
	} ;
	
	proto.targed = function(handler,options){
		var top = this ;
		if(top.nodeName=='FORM'){
			var frame = document.createElement('iframe') ;
			var targedDOC = {'_document':false, '_html':false, '_text':false, '_json':false} ;
			une_var = 'du text' ;
			frame.attr({'id':'helpframe','name':'helpframe','src':''}).css({'display':'none'}) ;
			document.body.appendChild(frame) ;
			top.target = 'helpframe' ;
			top.submit() ;
			
			frame.onload = function(){
				targedDOC._document = frame.contentDocument ;
				targedDOC._html = targedDOC._document.body.innerHTML ;
				targedDOC._text = targedDOC._document.body.textContent ;
				if(options && options.json==true) targedDOC._json = JSON.parse(targedDOC._text) ;
				frame.parentNode.removeChild(frame) ;
				if(handler) handler(targedDOC) ;
			} ;
		}
		else{
			console.log('method utilisable que sur element FORM.') ;
		}
		return top ;
	} ;

	proto.ajaxed = function(opts){
		var top = this;
		if(top.nodeName.toLowerCase()!="form") console.error("function utilisable seulement sur balise FORM") ;
		else{
			var q = new XMLHttpRequest(), form = new FormData(top) ;
			q.open(top.method,top.action) ;
			q.timeout = (opts.timeout)?opts.timeout:10000 ;
			q.send(form) ;
			q.onload = function(){
				if(q.status==200){
					if(opts.success) opts.success(q.responseText) ;
				}
				else{
					if(opts.error) opts.error() ;
				}
			} ;
			q.onprogress = function(e){
				if(opts.progress) opts.progress(((e.loaded*100)/e.total)) ;
			}
		}
	} ;
	
	/*
	* autocomplete received data format : 
	* <div class="_auto_">
	*	<img src="yourimage"/>
	*	<span>there you text</span>
	* </div>
	*/
	proto.autocomp = function(datas,handler){
		/*	datas proprieties and methods
			class : means the css class of auto box
			movingdefaultcss : correspond to default style attributed to element on selection in auto
			outputdefaultcss : correspond to default style attributed to auto
			value : Tell if user want to send value to server
			onselection : correspond to function which is execute when user select an item on auto
		*/
		var top = this, position = 0, written = "" ;
		if(top.nodeName=='INPUT' && top.getAttribute("type")=="text" || top.getAttribute("type")=="search"){
			var q = new XMLHttpRequest(),
			    auto = document.createElement('div') ;
			    
			    datas.class = (datas.class)?datas.class:'_box' ; // giving auto class
			    auto.css({
			    	"width":top.offsetWidth+"px",
			    	"minHeight":"0px",
			    	/* "maxHeight":"70px",
			    	"overflow":"auto",*/
			    	"position":"absolute",
			    	"left":top.offsetLeft - top.parentNode.offsetLeft + "px",
			    	"top":top.offsetTop - top.parentNode.offsetTop + top.offsetHeight + "px",
			    	"background":"white",
			    	"color":"black",
			    	"boxShadow":"0px 0px 2px 0px",
			    	"textAlign":"left",
			    	"padding":"0px",
			    	"zIndex":"2000"
			    	/*"border":"1px solid #000"*/
			    },100).attr({"class":datas.class}) ;
			    if(top.parentNode.css('position')=='static') top.parentNode.css({"position":"relative"}) ;
			    auto.addto(top.parentNode) ;
			    top.autocomplete = "off" ;
			    
			    datas.movingdefaultcss = {
			    	"background":"#d1d1d1",
			    	"color":"#319cee"
			    }
			    datas.outputdefaultcss = {
			    	"background":"#fff",
			    	"color":"#535353",
			    	"padding":"5px",
			    	"minHeight":"30px"
			    }
			
			top.onkeyup = function(e){
				if(top.value.length>0 && e.which!=18 && e.which!=17 && e.which!=16 && e.which!=20){
					switch(e.which){
						case 13:
							if(_('.h') && auto.css('display')!='none'){
								auto._hide() ;
								if(datas.onselection) datas.onselection(_('.h')) ;
							}
						break;

						case 27:
							auto._hide() ;
							top.value = written ;
						break ;

						case 38:
							e.preventDefault() ;
							if(!_('.h')){
								/* console.log(auto.childNodes.length) ; */
								var ft = auto.childNodes[auto.childNodes.length-1].nodeName=="#text"?auto.childNodes[auto.childNodes.length-1].previousSibling:auto.childNodes[auto.childNodes.length-1] ;
								ft.css(datas.movingdefaultcss) ;
								ft.adclax('h') ;
								setTimeout(function(){
									top.value = _('.h span').textContent ;
								},50) ;
							}
							else{
								var now = _('.h'), working = null ;
								/* Search for working div */
								if(now.previousSibling){
									if(now.previousSibling.nodeName=="#text"){
										if(now.previousSibling.previousSibling) working = now.previousSibling.previousSibling ;
										else{
											top.value = written ;
											top.focus() ;
										}
									}
									else{
										working = now.previousSibling ;
									}
								}
								else{
									top.value = written ;
									top.focus() ;
								}
								/* end of search */

								now.css(datas.outputdefaultcss) ;
								now.removeClax('h') ;
								if(now.previousSibling){	
									working.css(datas.movingdefaultcss) ;
									working.adclax('h') ;
									setTimeout(function(){
										top.value = _('.h span').textContent ;
									},50) ;
								}
							}
						break;

						case 40:
							e.preventDefault() ;
							if(!_('.h')){
								auto.childNodes[0].css(datas.movingdefaultcss) ;
								auto.childNodes[0].adclax('h') ;
								setTimeout(function(){
									top.value = _('.h span').textContent ;
								},50) ;
							}
							else{
								var now = _('.h'), working = null ;
								// Search for working div
								if(now.nextSibling){
									if(now.nextSibling.nodeName=="#text"){
										if(now.nextSibling.nextSibling) working = now.nextSibling.nextSibling ;
										else{
											top.value = written ;
											top.focus() ;
										}
									}
									else{
										working = now.nextSibling ;
									}
								}
								else{
									top.value = written ;
									top.focus() ;
								}
								// end of search

								now.css(datas.outputdefaultcss) ;
								now.removeClax('h') ;
								if(now.nextSibling){
									// now.attr({style:""}) ;	
									working.css(datas.movingdefaultcss) ;
									working.adclax('h') ;
									setTimeout(function(){
										top.value = _('.h span').textContent ;
									},50) ;
								}
							}
						break;

						default:
							written = top.value ; // memorizing top value
							q.open('GET',datas.to+'?'+datas.keyword+((datas.value==true)?'='+top.value:'')) ;
							q.send(null) ;
							q.onload = function(){
								// console.log(q.responseText) ;
								if(q.responseText.trim().length){
									auto.innerHTML = q.responseText.trim() ;
									auto._show() ;
								}
								else{
									auto.innerHTML = '' ;
									auto._hide() ;
								}
							} ;
						break;
					}
					// 
					// others event handling
					// 
					auto.onmouseover = function(e){
						// 
					} ;

					auto.onclick = function(e){
						var ti = e.target ;
						while(ti.hasclax && !ti.hasclax('_auto_')) ti = ti.parentNode ; 
						if(datas.onselection) datas.onselection(ti) ;
						ti.adclax('h') ;
						setTimeout(function(){ top.value = _('.h span').textContent ; },50) ;
						auto._hide() ;
						top.focus() ;
					} ;

				}

				else if(top.value.length==0){
					if(e.which==8) auto._hide() ;
				}
			}
		}
		else{console.log("ceci n'est pas le bon element sur lequel appliquer !");}
	} ;
	
	proto.addinput = function(attrs){
		var top = this ;
		if(top.nodeName=='FORM'){
			var input = document.createElement('input') ;
			//input.attr({'type':'text'}) ;
			input.attr(attrs) ;
			input.addto(top) ;
		}
		else{
			console.log('methode utilisable que sur element FORM') ;
		}
		return top ;
	} ;


	/* cette methode permettra de faire d'une balise div, ayant une certaine, un slider 
	*  La structure etant :
	*
	*  <div class="_screen">
	*		<div class="_pic-contain">
	*			<div><img src="img/a.jpg"></div>
	*			<div><img src="img/c.jpg"></div>
	*			<div><img src="img/b.jpg"></div>
	*		</div>
	*	</div>
	*
	*   En cours de finition
	*/
	proto.slideit = function(options={}){
		var top = this, delay = options.delay || 0 ;

		/* vérification de la structure */
			 if(!top.childNodes[1] || top.childNodes[1].nodeName!='DIV'){
			 	console.error('do_more: La structure de votre slider ne respecterais pas la structure imposée.') ;
			 }
			 else if(!top.childNodes[1].childNodes[1] || top.childNodes[1].childNodes[1].nodeName!='DIV'){
			 	console.error('do_more: La structure de votre slider ne respecterais pas la structure imposée.') ;
			 }
		/* Retrait des éléments n'ayant pas leur place ... */
			top.childNodes.each(function(el,rank){
				if(rank>=2) top.childNodes[rank].parentNode.removeChild(top.childNodes[rank]) ;
			}) ;

			top.childNodes[1].childNodes.each(function(el,rank){
				if(el.nodeName!='DIV') el.parentNode.removeChild(el) ;
			}) ;
		/* Application des styles adéquats */
			top.childNodes[1]._width(top._width()*_('._screen img',true).length + 100) ;
			top.childNodes[1]._height(top._height()) ;
			top.childNodes[1].childNodes.each(function(a,b){ a._width(top._width()) ; a._height(top._height()) ; a.css({display:'inline-block',verticalAlign:'top'}); }) ;
			_('._screen img',true).each(function(a,b){ a._width('100%') ; }) ;
		/* --- */

		setTimeout(function(){
			/* à continuer ... */
		}, delay) ;
		return top ;
	} ;
	
	proto.redirectframe = function(src,delay){
		var top = this ;
		if(top.nodeName.toLowerCase()=='iframe'){
			setTimeout(function(){
				top.src = src ;
			},delay||0) ;
		}else{
			console.log("cette fonction n'est applicable que sur les objets de type iframe.") ;
		}
	} ;
	
	proto.presentYou = function(){
		present = '{"id":"'+this.id+
				'", "class":"'+this.className+
				'", "childs":"'+this.childNodes.length+
			'"}' ;
		present = JSON.parse(present) ;
		return present ;
	} ;
	
	
	// here goes usual function
	
	function _(sel,toArray){ // this to reduce querySelector
		if(toArray)
			return document.querySelectorAll(sel) ;
		else if(document.querySelectorAll(sel).length > 1)
			return document.querySelectorAll(sel) ;
		else 
			return document.querySelector(sel) ;
	}

	function _ajax(opts){
		var params = '' ;
		var q = new XMLHttpRequest() ;
			q.open(opts.type,opts.url) ;
			if(opts.params && typeof opts.params === 'object'){
				for(var a in opts.params){
					params += a+"="+opts.params[a]+"&" ;
				}
				/*remove last "&" in params*/ params = params.substring(0,params.length-1) ;
				/* check for adaptive params in params var */
			}
			else if(opts.params && typeof opts.params === 'string'){
				params = opts.params ;
			}

			if(opts.type.toLowerCase()=='post'){
				if(params=='' || params.length==0){
					console.error("paramètres requis pour une requète de type POST") ;
					return ;
				}
				else{
					// console.log(params) ;
					q.setRequestHeader('Content-Type','application/x-www-form-urlencoded') ;
					q.send(params) ;
				}
			}
			else if(opts.type.toLowerCase()=='get'){
				q.send(null) ;
			}

			// if(q.timeout) q.timeout = opts.timeout || 10000 ;

			q.onload = function(e){
				if(q.readyState==q.DONE){
					if(q.status==200) if(opts.success) opts.success(q.responseText) ;
					else if(q.status!=200) if(opts.error) opts.error() ;
				}
				else console.error("problème survenu avec la requète !") ;
			} ;

			q.onprogress = function(e){
				var percent = (e.loaded*100)/e.total ;
				if(opts.progress) opts.progress(percent) ;
			} ;
	}

	// modified ---------------------------------------------------------------------------------//////-----------//////----------
	function _createElement(elName,properties,css_prop,addto,content){
		var top = this ;
		var el = document.createElement(elName) ;
		if(css_prop) el.css(css_prop) ;
		if(properties) el.attr(properties) ;
		if(content) el.innerHTML = content ;
		if(addto) el.addto(addto) ;
		return el ;
	}
	
	function redirectwindow(src,delay){
		setTimeout(function(){
			if(window) window.location.href = src ; else return ;
		},delay||0) ;
	}

	function _pregMatch(exp, handle){
		var len = exp.length, exploiting = '', isOn = false ;
		for(var i=0; i<handle.length; i++){
			exploiting = '' ;
			for(var j=i; j<(i+len); j++){
				if(!handle[j]) break ;
				else exploiting += handle[j] ;
			}
			// console.log(exploiting) ;
			if(exploiting==exp){
				isOn = true ;
				break ;
			}
		}
		return isOn ;
	}
	
	
	// animate functions
	
	proto._animate = function(opts){
		var start = new Date ;
		var top = this ;

		var id = setInterval(function(){
			var timePassed = new Date - start ;
			var progress = timePassed/opts.duration ;

			if(progress>1) progress = 1 ;

			var delta = funcs[opts.type](progress) ;
			opts.step(delta) ;

			if(progress==1) clearInterval(id) ;
		}, opts.delay||10) ;

		var funcs = {
			linear : function linear(p){ return p ; },
			slowFast : function slowFast(p){ return Math.pow(p, 2) ; },
			slowFast_1 : function slowFast_1(p){ return Math.pow(p, 4) ; },
			back : function back (p){ return Math.pow(p, 2) * ((0.5 + 1) * p - 0.5) ; }
		} ;
	}

// here is created the alert object
		function __alert(){
			// this for alert() 
			var back = _createElement('div',{},{
				background:"rgba(0,0,0,0.4)",
				position:"fixed",
				top: "0",
				width:"100%", height:"100%", zIndex:"300000",
				display: "none" ,
				transition: "all 0.2s ease"
			}, document.body) ;
			var box = _createElement('div',{},{
				background: "#fff",
				borderTop: "30px solid #319cee",
				position: "absolute",
				width: "40%",
				maxWidth: "350px",
				borderRadius: "7px",
				padding: "20px 10px",
				opacity: "0",
				transition: "all 0.2s ease"
			}, back) ;
			var close = _createElement('button',{},{
				width: "20px",
				height: "20px",
				position: "absolute",
				background: "#e63e5e",
				top: "-25px",
				right: "10px",
				borderRadius: "10px",
				fontFamily: "arial",
				color: "#fff",
				border: "none"
			}, box) ; close.textContent = "" ;
			var text = _createElement('div',{},{
				textAlign: "center",
				fontSize: "1.2em"
			}, box) ;
			// end of for alert and now for prompt
			var input = _createElement('input',{type:'text',id:'_prompt'},{
				width: "70%",
				padding: "7px",
				border: "1px solid #ccc",
				marginTop: "10px"
			}) ;
			var valid = _createElement('button',{},{
				width: "30px",
				height: "30px",
				border: "none",
				background: "#aaa",
				borderRadius: "25px",
				marginLeft: "10px"
			}) ; valid.textContent = "ok" ;
			// now for small alert
			var smallbox = _createElement('div',{class:"smallbox"},{
				width: '170px',
				padding: '5px',
				borderRadius: '3px',
				border: '1px solid #aaa',
				background: '#fff',
				position: 'absolute',
				top: '-170px',
				left: '-170px',
				opacity: '0',
				transition: 'all 0.1s ease'
			},document.body) ;
			var index = _createElement('span',{},{
				position: 'absolute',
				bottom: '-6px',
				left: '20px',
				width: '10px',
				height: '10px',
				background: '#fff',
				border: '0px solid #ccc',
				borderBottom: '1px solid #aaa',
				borderRight: '1px solid #aaa',
				transform: 'rotate(45deg)',
				zIndex: '1000'
			},smallbox) ;
			var smalltext = _createElement('div',{},{
				color: '#636363',
				fontSize: '13px',
			},smallbox) ;
			var smallinput = _createElement('input',{type:'text'},{
				border: '1px solid #ccc',
				padding: '4px',
				width: '70%'
			}) ;
			var smallvalid = _createElement('button',{},{
				width: '23px',
				height: '23px',
				border: 'none',
				background: '#ccc',
				borderRadius: '15px',
				fontSize: '11px',
				marginLeft: '12px'
			}) ; smallvalid.textContent = 'ok' ;
			var closemin = function(){
				smallbox.css({opacity:'0'}).css({top:'-500px',left:'-170px'},100) ;
				if(smallvalid.parentNode){ smallvalid._remove(); smallinput._remove(); }
			} ;


			this._alert = function(message,style,events){
				text.innerHTML = message ;
				if(style) box.css(style) ;
				back.css({display:"block",opacity:"1"}) ;
				box.centerXY() ;
				box.css({opacity:'1'}) ;
				close.onclick = function(){
					back.css({opacity:"0"}).css({display:"none"},300) ;
					if(events && events.close) events.close() ;
				} ;
			} ;

			this._prompt = function(message,events){
				text.css({margin:'-10px 0 10px 0',fontSize:'17px'}).innerHTML = message ;
				input.addto(box) ;
				valid.addto(box) ;
				box.css({textAlign:'center'}) ;
				back.css({display:"block",opacity:"1"}) ;
				box.centerXY() ;
				box.css({opacity:'1'}) ;
				close.onclick = function(){
					back.css({opacity:"0"}).css({display:"none"},300) ;
					input._remove() ;
					valid._remove() ;
					if(events.close) events.close() ;
				} ;
				valid.onclick = function(){
					back.css({opacity:"0"}).css({display:"none"},300) ;
					if(events.confirm) events.confirm(input.value) ;
				} ;
			} ;

			this._minalert = function(msg,el,setStyle){
				if(el instanceof HTMLElement == false || el.nodeName=='BODY'){
					console.error("L'élément passé en paramètre à _minalert n'est pas un élément html ou n'est pas autorisé pour cette fonction.") ;
					return ;
				}
				if(_('.smallbox')) _('.smallbox')._remove() ;
				smallbox.addto(document.body) ;
				smalltext.innerHTML = msg ;
				if(setStyle) smallbox.css(setStyle) ;
				smallbox.css({left:el.offsetLeft+'px', top:(el.offsetTop-smallbox.offsetHeight)+'px'}).css({opacity:'1'},300) ;
				smallbox.onclick = function(){ closemin() ; } ;
			} ;
		}
//  end of alert object creating