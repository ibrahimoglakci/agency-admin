!function(e){"use strict";e("#wizard1").steps({headerTag:"h3",bodyTag:"section",autoFocus:!0,titleTemplate:'<span class="number">#index#</span> <span class="title">#title#</span>'}),e("#wizard2").steps({headerTag:"h3",bodyTag:"section",autoFocus:!0,titleTemplate:'<span class="number">#index#</span> <span class="title">#title#</span>',onStepChanging:function(a,i,s){if(!(i<s))return!0;if(0===i){var t=e("#firstname").parsley(),r=e("#lastname").parsley();if(t.isValid()&&r.isValid())return!0;t.validate(),r.validate()}if(1===i){var n=e("#email").parsley();if(n.isValid())return!0;n.validate()}}}),e("#wizard3").steps({headerTag:"h3",bodyTag:"section",autoFocus:!0,titleTemplate:'<span class="number">#index#</span> <span class="title">#title#</span>',stepsOrientation:1}),e(".dropify-clear").on("click",function(){e(".dropify-render img").remove(),e(".dropify-preview").css("display","none"),e(".dropify-clear").css("display","none")}),e("#form").accWizard({mode:"wizard",autoButtonsNextClass:"btn btn-primary float-end",autoButtonsPrevClass:"btn btn-light",stepNumberClass:"badge rounded-pill bg-primary me-1",onSubmit:function(){return alert("Form submitted!"),!0}})}(jQuery);function readURL(e){"use strict";if(e.files&&e.files[0]){var a=new FileReader;a.onload=function(e){$(".dropify-render img").remove();var a=$('<img id="dropify-img">');a.attr("src",e.target.result),a.appendTo(".dropify-render"),$(".dropify-preview").css("display","block"),$(".dropify-clear").css("display","block")},a.readAsDataURL(e.files[0])}}