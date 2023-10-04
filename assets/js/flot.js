function labelFormatter(e,t){return"<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>"+e+"<br/>"+Math.round(t.percent)+"%</div>"}function setCode(e){"use strict";$("#code").text(e.join("\n"))}$(function(){"use strict";for(var e=[],t=[],o=0;o<14;o+=.1)e.push([o,Math.sin(o)]),t.push([o,Math.cos(o)]);$.plot("#placeholder1",[{data:e},{data:t}],{series:{lines:{show:!0}},lines:{show:!0,fill:!0,fillColor:{colors:[{opacity:.7},{opacity:.7}]}},crosshair:{mode:"x"},grid:{hoverable:!1,autoHighlight:!1,borderColor:"rgba(119, 119, 142, 0.1)",verticalLines:!1,horizontalLines:!1},colors:["#6c5ffc","#05c3fb"],yaxis:{min:-1.2,max:1.2,tickLength:0},xaxis:{tickLength:0}})}),$(function(){"use strict";for(var e=[],t=[],o=0;o<14;o+=.5)e.push([o,Math.sin(o)]),t.push([o,Math.cos(o)]);$.plot("#placeholder2",[{data:e,label:"data1"},{data:t,label:"data2"}],{series:{lines:{show:!0},points:{show:!0}},grid:{hoverable:!0,clickable:!0,borderColor:"rgba(119, 119, 142, 0.1)",verticalLines:!1,horizontalLines:!1},colors:["#6c5ffc","#05c3fb"],yaxis:{min:-1.2,max:1.2,tickLength:0},xaxis:{tickLength:0}})}),$(function(){"use strict";var e=[];function t(){for(e.length>0&&(e=e.slice(1));e.length<300;){var t=(e.length>0?e[e.length-1]:50)+10*Math.random()-5;t<0?t=0:t>100&&(t=100),e.push(t)}for(var o=[],i=0;i<e.length;++i)o.push([i,e[i]]);return o}var o=30;$("#updateInterval").val(o).change(function(){var e=$(this).val();e&&!isNaN(+e)&&((o=+e)<1?o=1:o>2e3&&(o=2e3),$(this).val(""+o))});var i=$.plot("#placeholder4",[t()],{series:{shadowSize:0},grid:{borderColor:"rgba(119, 119, 142, 0.1)"},colors:["#6c5ffc"],yaxis:{min:0,max:100,tickLength:0},xaxis:{tickLength:0,show:!1}});!function e(){i.setData([t()]),i.draw(),setTimeout(e,o)}()}),$(function(){"use strict";for(var e=[],t=0;t<=10;t+=1)e.push([t,parseInt(30*Math.random())]);for(var o=[],t=0;t<=10;t+=1)o.push([t,parseInt(30*Math.random())]);for(var i=[],t=0;t<=10;t+=1)i.push([t,parseInt(30*Math.random())]);var a=0,l=!0,r=!1,n=!1;function s(){$.plot("#placeholder6",[e,o,i],{series:{stack:a,lines:{show:r,fill:!0,steps:n},bars:{show:l,barWidth:.6}},grid:{borderColor:"rgba(119, 119, 142, 0.1)"},colors:["#6c5ffc","#05c3fb"],yaxis:{tickLength:0},xaxis:{tickLength:0,show:!1}})}s(),$(".stackControls button").click(function(e){e.preventDefault(),a="With stacking"==$(this).text()||null,s()}),$(".graphControls button").click(function(e){e.preventDefault(),l=-1!=$(this).text().indexOf("Bars"),r=-1!=$(this).text().indexOf("Lines"),n=-1!=$(this).text().indexOf("steps"),s()})}),$(function(){"use strict";for(var e=[],t=Math.floor(4*Math.random())+3,o=0;o<t;o++)e[o]={label:"Series"+(o+1),data:Math.floor(100*Math.random())+1};var i=$("#placeholder");$("#example-1").on("click",function(){i.unbind(),$("#title").text("Default pie chart"),$("#description").text("The default pie chart with no options set."),$.plot(i,e,{series:{pie:{show:!0}},colors:["#6c5ffc","#05c3fb","#09ad95","#1170e4","#f82649"]})}),$("#example-2").on("click",function(){i.unbind(),$("#title").text("Default without legend"),$("#description").text("The default pie chart when the legend is disabled. Since the labels would normally be outside the container, the chart is resized to fit."),$.plot(i,e,{series:{pie:{show:!0}},colors:["#6c5ffc","#05c3fb","#09ad95","#1170e4","#f82649"],legend:{show:!1}})}),$("#example-3").on("click",function(){i.unbind(),$("#title").text("Custom Label Formatter"),$("#description").text("Added a semi-transparent background to the labels and a custom labelFormatter function."),$.plot(i,e,{series:{pie:{show:!0,radius:1,label:{show:!0,radius:1,formatter:labelFormatter,background:{opacity:.8}}}},colors:["#1170e4","#d43f8d","#45aaf2","#ecb403","#e86a91"],legend:{show:!1}})}),$("#example-4").on("click",function(){i.unbind(),$("#title").text("Label Radius"),$("#description").text("Slightly more transparent label backgrounds and adjusted the radius values to place them within the pie."),$.plot(i,e,{series:{pie:{show:!0,radius:1,label:{show:!0,radius:3/4,formatter:labelFormatter,background:{opacity:.5}}}},colors:["#1170e4","#d43f8d","#45aaf2","#ecb403","#64E572"],legend:{show:!1}})}),$("#example-5").on("click",function(){i.unbind(),$("#title").text("Label Styles #1"),$("#description").text("Semi-transparent, black-colored label background."),$.plot(i,e,{series:{pie:{show:!0,radius:1,label:{show:!0,radius:3/4,formatter:labelFormatter,background:{opacity:.5,color:"#000"}}}},colors:["#1170e4","#d43f8d","#45aaf2","#ecb403","#e86a91"],legend:{show:!1}})}),$("#example-6").on("click",function(){i.unbind(),$("#title").text("Label Styles #2"),$("#description").text("Semi-transparent, black-colored label background placed at pie edge."),$.plot(i,e,{series:{pie:{show:!0,radius:3/4,label:{show:!0,radius:3/4,formatter:labelFormatter,background:{opacity:.5,color:"#000"}}}},colors:["#1170e4","#d43f8d","#45aaf2","#ecb403","#e86a91"],legend:{show:!1}})}),$("#example-7").on("click",function(){i.unbind(),$("#title").text("Hidden Labels"),$("#description").text("Labels can be hidden if the slice is less than a given percentage of the pie (10% in this case)."),$.plot(i,e,{series:{pie:{show:!0,radius:1,label:{show:!0,radius:2/3,formatter:labelFormatter,threshold:.1}}},colors:["#1170e4","#d43f8d","#45aaf2","#ecb403","#e86a91"],legend:{show:!1}})}),$("#example-8").on("click",function(){i.unbind(),$("#title").text("Combined Slice"),$("#description").text("Multiple slices less than a given percentage (5% in this case) of the pie can be combined into a single, larger slice."),$.plot(i,e,{series:{pie:{show:!0,combine:{color:"#999",threshold:.05}}},colors:["#1170e4","#d43f8d","#45aaf2","#ecb403","#e86a91"],legend:{show:!1}})}),$("#example-9").on("click",function(){i.unbind(),$("#title").text("Rectangular Pie"),$("#description").text("The radius can also be set to a specific size (even larger than the container itself)."),$.plot(i,e,{series:{pie:{show:!0,radius:500,label:{show:!0,formatter:labelFormatter,threshold:.1}}},colors:["#1170e4","#d43f8d","#45aaf2","#ecb403","#e86a91"],legend:{show:!1}})}),$("#example-10").on("click",function(){i.unbind(),$("#title").text("Tilted Pie"),$("#description").text("The pie can be tilted at an angle."),$.plot(i,e,{series:{pie:{show:!0,radius:1,tilt:.5,label:{show:!0,radius:1,formatter:labelFormatter,background:{opacity:.8}},combine:{color:"#999",threshold:.1}}},colors:["#1170e4","#d43f8d","#45aaf2","#ecb403","#e86a91"],legend:{show:!1}})}),$("#example-11").on("click",function(){i.unbind(),$("#title").text("Donut Hole"),$("#description").text("A donut hole can be added."),$.plot(i,e,{series:{pie:{innerRadius:.5,show:!0}}})}),$("#example-1").click()});