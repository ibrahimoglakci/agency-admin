const pickrContainer=document.querySelector(".pickr-container"),themeContainer=document.querySelector(".theme-container"),pickrContainer1=document.querySelector(".pickr-container1"),themeContainer1=document.querySelector(".theme-container1"),pickrContainer2=document.querySelector(".pickr-container2"),themeContainer2=document.querySelector(".theme-container2"),themes=[["classic",{swatches:["rgba(244, 67, 54, 1)","rgba(233, 30, 99, 0.95)","rgba(156, 39, 176, 0.9)","rgba(103, 58, 183, 0.85)","rgba(63, 81, 181, 0.8)","rgba(33, 150, 243, 0.75)","rgba(3, 169, 244, 0.7)","rgba(0, 188, 212, 0.7)","rgba(0, 150, 136, 0.75)","rgba(76, 175, 80, 0.8)","rgba(139, 195, 74, 0.85)","rgba(205, 220, 57, 0.9)","rgba(255, 235, 59, 0.95)","rgba(255, 193, 7, 1)"],components:{preview:!0,opacity:!0,hue:!0,interaction:{hex:!0,rgba:!0,hsva:!0,input:!0,clear:!0,save:!0}}}],],buttons=[];let pickr=null;for(const[theme,config]of themes){let e=document.createElement("button");e.innerHTML=theme,buttons.push(e),e.addEventListener("click",()=>{let n=document.createElement("p");for(let t of(pickrContainer.appendChild(n),pickr&&pickr.destroyAndRemove(),buttons))t.classList[t===e?"add":"remove"]("active");(pickr=new Pickr(Object.assign({el:n,theme,default:"#6c5ffc"},config))).on("init",e=>{console.log('Event: "init"',e)}).on("hide",e=>{console.log('Event: "hide"',e)}).on("show",(e,n)=>{console.log('Event: "show"',e,n)}).on("save",(e,n)=>{console.log('Event: "save"',e,n)}).on("clear",e=>{console.log('Event: "clear"',e)}).on("change",(e,n,t)=>{console.log('Event: "change"',e,n,t)}).on("changestop",(e,n)=>{console.log('Event: "changestop"',e,n)}).on("cancel",e=>{console.log("cancel",pickr.getColor().toRGBA().toString(0))}).on("swatchselect",(e,n)=>{console.log('Event: "swatchselect"',e,n)})}),themeContainer.appendChild(e)}buttons[0].click();const monolithThemes=[["monolith",{swatches:["rgba(244, 67, 54, 1)","rgba(233, 30, 99, 0.95)","rgba(156, 39, 176, 0.9)","rgba(103, 58, 183, 0.85)","rgba(63, 81, 181, 0.8)","rgba(33, 150, 243, 0.75)","rgba(3, 169, 244, 0.7)"],defaultRepresentation:"HEXA",components:{preview:!0,opacity:!0,hue:!0,interaction:{hex:!1,rgba:!1,hsva:!1,input:!0,clear:!0,save:!0}}}]],monolithButtons=[];let monolithPickr=null;for(const[theme,config]of monolithThemes){let n=document.createElement("button");n.innerHTML=theme,monolithButtons.push(n),n.addEventListener("click",()=>{let e=document.createElement("p");for(let t of(pickrContainer1.appendChild(e),monolithPickr&&monolithPickr.destroyAndRemove(),monolithButtons))t.classList[t===n?"add":"remove"]("active");(monolithPickr=new Pickr(Object.assign({el:e,theme,default:"#fc5296"},config))).on("init",e=>{console.log('Event: "init"',e)}).on("hide",e=>{console.log('Event: "hide"',e)}).on("show",(e,n)=>{console.log('Event: "show"',e,n)}).on("save",(e,n)=>{console.log('Event: "save"',e,n)}).on("clear",e=>{console.log('Event: "clear"',e)}).on("change",(e,n,t)=>{console.log('Event: "change"',e,n,t)}).on("changestop",(e,n)=>{console.log('Event: "changestop"',e,n)}).on("cancel",e=>{console.log("cancel",monolithPickr.getColor().toRGBA().toString(0))}).on("swatchselect",(e,n)=>{console.log('Event: "swatchselect"',e,n)})}),themeContainer1.appendChild(n)}monolithButtons[0].click();const nanoThemes=[["nano",{swatches:["rgba(244, 67, 54, 1)","rgba(233, 30, 99, 0.95)","rgba(156, 39, 176, 0.9)","rgba(103, 58, 183, 0.85)","rgba(63, 81, 181, 0.8)","rgba(33, 150, 243, 0.75)","rgba(3, 169, 244, 0.7)"],defaultRepresentation:"HEXA",components:{preview:!0,opacity:!0,hue:!0,interaction:{hex:!1,rgba:!1,hsva:!1,input:!0,clear:!0,save:!0}}}]],nanoButtons=[];let nanoPickr=null;for(const[theme,config]of nanoThemes){let t=document.createElement("button");t.innerHTML=theme,nanoButtons.push(t),t.addEventListener("click",()=>{let e=document.createElement("p");for(let n of(pickrContainer2.appendChild(e),nanoPickr&&nanoPickr.destroyAndRemove(),nanoButtons))n.classList[n===t?"add":"remove"]("active");(nanoPickr=new Pickr(Object.assign({el:e,theme,default:"#05c3fb"},config))).on("init",e=>{console.log('Event: "init"',e)}).on("hide",e=>{console.log('Event: "hide"',e)}).on("show",(e,n)=>{console.log('Event: "show"',e,n)}).on("save",(e,n)=>{console.log('Event: "save"',e,n)}).on("clear",e=>{console.log('Event: "clear"',e)}).on("change",(e,n,t)=>{console.log('Event: "change"',e,n,t)}).on("changestop",(e,n)=>{console.log('Event: "changestop"',e,n)}).on("cancel",e=>{console.log("cancel",nanoPickr.getColor().toRGBA().toString(0))}).on("swatchselect",(e,n)=>{console.log('Event: "swatchselect"',e,n)})}),themeContainer2.appendChild(t)}nanoButtons[0].click();