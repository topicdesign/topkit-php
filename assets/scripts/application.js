$(document).ready(function(){Modernizr.load([{test:window.JSON,nope:"assets/scripts/libs/json2.min.js"}])});
/*!
 * jNotify jQuery Plug-in
 *
 * Copyright 2010 Giva, Inc. (http://www.givainc.com/labs/) 
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 * 	http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * Date: 2010-09-30
 * Rev:  1.1.00
 */
(function(b){b.jnotify=function(k,n,l){return new c(k,n,l)};b.jnotify.version="1.1.00";var j,d=[],e=0,h=false,i=false,g,f,a={type:"",delay:2000,sticky:false,closeLabel:"&times;",showClose:true,fadeSpeed:1000,slideSpeed:250,classContainer:"jnotify-container",classNotification:"jnotify-notification",classBackground:"jnotify-background",classClose:"jnotify-close",classMessage:"jnotify-message",init:null,create:null,beforeRemove:null,remove:null,transition:null};b.jnotify.setup=function(k){a=b.extend({},a,k)};b.jnotify.play=function(m,n){if(h&&(m!==true)||(d.length==0)){return}h=true;var l=d.shift();f=l;var k=(arguments.length>=2)?parseInt(n,10):l.options.delay;g=setTimeout(function(){g=0;l.remove(function(){if(d.length==0){h=false}else{if(!i){b.jnotify.play(true)}}})},k)};b.jnotify.pause=function(){clearTimeout(g);if(g){d.unshift(f)}i=h=true};b.jnotify.resume=function(){i=false;b.jnotify.play(true,0)};function c(p,n){var m=this,k=typeof n;if(k=="number"){n=b.extend({},a,{delay:n})}else{if(k=="boolean"){n=b.extend({},a,{sticky:true})}else{if(k=="string"){n=b.extend({},a,{type:n,delay:((arguments.length>2)&&(typeof arguments[2]=="number"))?arguments[2]:a.delay,sticky:((arguments.length>2)&&(typeof arguments[2]=="boolean"))?arguments[2]:a.sticky})}else{n=b.extend({},a,n)}}}this.options=n;if(!j){j=b('<div class="'+a.classContainer+'" />').appendTo("body");if(b.isFunction(n.init)){n.init.apply(m,[j])}}function o(s){var r='<div class="'+n.classNotification+(n.type.length?(" "+n.classNotification+"-"+n.type):"")+'"><div class="'+n.classBackground+'"></div>'+(n.sticky&&n.showClose?('<a class="'+n.classClose+'">'+n.closeLabel+"</a>"):"")+'<div class="'+n.classMessage+'"><div>'+s+"</div></div></div>";e++;var q=b(r);if(n.sticky){q.find("a."+n.classClose).bind("click.jnotify",function(){m.remove()})}if(b.isFunction(n.create)){n.create.apply(m,[q])}return q.appendTo(j)}this.remove=function(u){var q=l.find("."+n.classMessage),s=q.parent();var r=e--;if(b.isFunction(n.beforeRemove)){n.beforeRemove.apply(m,[q])}function t(){s.remove();if(b.isFunction(u)){u.apply(m,[q])}if(b.isFunction(n.remove)){n.remove.apply(m,[q])}}if(b.isFunction(n.transition)){n.transition.apply(m,[s,q,r,t,n])}else{q.fadeTo(n.fadeSpeed,0.01,function(){if(r<=1){t()}else{s.slideUp(n.slideSpeed,t)}});if(e<=0){s.fadeOut(n.fadeSpeed)}}};var l=o(p);if(!n.sticky){d.push(this);b.jnotify.play()}return this}})(jQuery);(function(){var a;a=function(){return $("div.status").each(function(){var c,b;b=$(this).data("type");c=false;if(b==="error"||b==="warning"){c=true}return $(this).find("ul li").each(function(){return $.jnotify($(this).text(),b,c)})})};$(document).ready(function(){return a()})}).call(this);