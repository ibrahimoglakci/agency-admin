$(function(e){"use strict";$(".select2").select2({minimumResultsForSearch:1/0,width:"100%"}),$(".select2-show-search").select2({minimumResultsForSearch:"",width:"100%"}),$(".select2").on("click",()=>{document.querySelectorAll(".select2-search__field").forEach((e,c)=>{e.focus()})})});