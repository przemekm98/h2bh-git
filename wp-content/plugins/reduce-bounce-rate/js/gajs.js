var _gaq=_gaq||[];var stFailbackDefaults={trackScrolling:true,stLogInterval:10,docTitle:window.document.title,cutOffTime:900,trackNoEvents:false,trackNoMaxTime:false};window.total_time=0;var stIntervalObj=null;var EventNONInteraction=false;var Frequency=null;var Repentance=null;function TrackingLogTime(a){return a[0]==50?(parseInt(a[1])+1)+":00":(a[1]||"0")+":"+(parseInt(a[0])+10)}function stInitializeControlVars(){if(typeof window.trackScrolling=="undefined"){window.trackScrolling=window.stFailbackDefaults.trackScrolling}if(typeof window.stLogInterval=="undefined"){window.stLogInterval=window.stFailbackDefaults.stLogInterval*1000}if(typeof window.docTitle=="undefined"){window.docTitle=window.stFailbackDefaults.docTitle}if(typeof window.cutOffTime=="undefined"){window.cutOffTime=window.stFailbackDefaults.cutOffTime}if(typeof window.trackNoEvents=="undefined"){window.trackNoEvents=window.stFailbackDefaults.trackNoEvents}if(typeof window.trackNoMaxTime=="undefined"){window.trackNoMaxTime=window.stFailbackDefaults.trackNoMaxTime}if(window.trackScrolling===true){setTimeout(function(){window.onscroll=function(){window.onscroll=null;_gaq.push(["_trackEvent","Scroll",window.docTitle,"scrolled"])}},2000)}}if(window.trackNoEvents===false){function startTimeTracking(a){stInitializeControlVars();window.stIntervalObj=window.setInterval(function(){total_time+=10;if(window.trackNoMaxTime===true){total_time=1}if(window.total_time<=window.cutOffTime){a=TrackingLogTime(a.split(":").reverse());_gaq.push(["_trackEvent","event","Time","Log",a])}else{window.clearInterval(window.stIntervalObj)}},(window.stLogInterval))}jQuery(document).ready(function(){startTimeTracking("00")})}if(window.trackScrollingPercentage===true){Frequency=ScrollingPercentageNumber;Repentance=100/ScrollingPercentageNumber;var ScrollMatrix=new Array();for(ix=0;ix<Repentance;ix++){ScrollMatrix[ix]=[Frequency,"false"];Frequency=ScrollingPercentageNumber+Frequency}$(document).scroll(function(a){for(iz=0;iz<ScrollMatrix.length;iz++){if(($(window).scrollTop()+$(window).height()>=$(document).height()*ScrollMatrix[iz][0]/100)&&(ScrollMatrix[iz][1]=="false")){ScrollMatrix[iz][1]="true";_gaq.push(["_trackEvent","event","Percentage Page Scroll",window.docTitle,ScrollMatrix[iz][0]+"%",{nonInteraction:EventNONInteraction}])}}})};