(function(a,b){if(typeof define==="function"&&define.amd){define(b)}else{if(typeof exports==="object"){module.exports=b()}else{a.NProgress=b()}}})(this,function(){var e={};e.version="0.1.6";var b=e.settings={minimum:0.08,easing:"ease",positionUsing:"",speed:200,trickle:true,trickleRate:0.02,trickleSpeed:800,showSpinner:true,barSelector:'[role="bar"]',spinnerSelector:'[role="spinner"]',parent:"body",template:'<div class="bar" role="bar"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'};e.configure=function(m){var n,o;for(n in m){o=m[n];if(o!==undefined&&m.hasOwnProperty(n)){b[n]=o}}return this};e.status=null;e.set=function(s){var m=e.isStarted();s=g(s,b.minimum,1);e.status=(s===1?null:s);var o=e.render(!m),p=o.querySelector(b.barSelector),q=b.speed,r=b.easing;o.offsetWidth;i(function(n){if(b.positionUsing===""){b.positionUsing=e.getPositioningCSS()}h(p,a(s,q,r));if(s===1){h(o,{transition:"none",opacity:1});o.offsetWidth;setTimeout(function(){h(o,{transition:"all "+q+"ms linear",opacity:0});setTimeout(function(){e.remove();n()},q)},q)}else{setTimeout(n,q)}});return this};e.isStarted=function(){return typeof e.status==="number"};e.start=function(){if(!e.status){e.set(0)}var m=function(){setTimeout(function(){if(!e.status){return}e.trickle();m()},b.trickleSpeed)};if(b.trickle){m()}return this};e.done=function(m){if(!m&&!e.status){return this}return e.inc(0.3+0.5*Math.random()).set(1)};e.inc=function(m){var o=e.status;if(!o){return e.start()}else{if(typeof m!=="number"){m=(1-o)*g(Math.random()*o,0.1,0.95)}o=g(o+m,0,0.994);return e.set(o)}};e.trickle=function(){return e.inc(Math.random()*b.trickleRate)};(function(){var m=0,n=0;e.promise=function(o){if(!o||o.state()=="resolved"){return this}if(n==0){e.start()}m++;n++;o.always(function(){n--;if(n==0){m=0;e.done()}else{e.set((m-n)/m)}});return this}})();e.render=function(m){if(e.isRendered()){return document.getElementById("nprogress")}j(document.documentElement,"nprogress-busy");var n=document.createElement("div");n.id="nprogress";n.innerHTML=b.template;var q=n.querySelector(b.barSelector),o=m?"-100":c(e.status||0),p=document.querySelector(b.parent),r;h(q,{transition:"all 0 linear",transform:"translate3d("+o+"%,0,0)"});if(!b.showSpinner){r=n.querySelector(b.spinnerSelector);r&&k(r)}if(p!=document.body){j(p,"nprogress-custom-parent")}p.appendChild(n);return n};e.remove=function(){l(document.documentElement,"nprogress-busy");l(document.querySelector(b.parent),"nprogress-custom-parent");var m=document.getElementById("nprogress");m&&k(m)};e.isRendered=function(){return!!document.getElementById("nprogress")};e.getPositioningCSS=function(){var m=document.body.style;var n=("WebkitTransform"in m)?"Webkit":("MozTransform"in m)?"Moz":("msTransform"in m)?"ms":("OTransform"in m)?"O":"";if(n+"Perspective"in m){return"translate3d"}else{if(n+"Transform"in m){return"translate"}else{return"margin"}}};function g(p,o,m){if(p<o){return o}if(p>m){return m}return p}function c(m){return(-1+m)*100}function a(q,o,p){var m;if(b.positionUsing==="translate3d"){m={transform:"translate3d("+c(q)+"%,0,0)"}}else{if(b.positionUsing==="translate"){m={transform:"translate("+c(q)+"%,0)"}}else{m={"margin-left":c(q)+"%"}}}m.transition="all "+o+"ms "+p;return m}var i=(function(){var n=[];function m(){var o=n.shift();if(o){o(m)}}return function(o){n.push(o);if(n.length==1){m()}}})();var h=(function(){var m=["Webkit","O","Moz","ms"],r={};function o(s){return s.replace(/^-ms-/,"ms-").replace(/-([\da-z])/gi,function(t,u){return u.toUpperCase()})}function q(s){var u=document.body.style;if(s in u){return s}var t=m.length,w=s.charAt(0).toUpperCase()+s.slice(1),v;while(t--){v=m[t]+w;if(v in u){return v}}return s}function p(s){s=o(s);return r[s]||(r[s]=q(s))}function n(s,u,t){u=p(u);s.style[u]=t}return function(u,t){var s=arguments,w,v;if(s.length==2){for(w in t){v=t[w];if(v!==undefined&&t.hasOwnProperty(w)){n(u,w,v)}}}else{n(u,s[1],s[2])}}})();function f(n,m){var o=typeof n=="string"?n:d(n);return o.indexOf(" "+m+" ")>=0}function j(n,m){var p=d(n),o=p+m;if(f(p,m)){return}n.className=o.substring(1)}function l(n,m){var p=d(n),o;if(!f(n,m)){return}o=p.replace(" "+m+" "," ");n.className=o.substring(1,o.length-1)}function d(m){return(" "+(m.className||"")+" ").replace(/\s+/gi," ")}function k(m){m&&m.parentNode&&m.parentNode.removeChild(m)}return e});