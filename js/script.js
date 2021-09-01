$(document).ready(function(){

	$(function(){ 
    $('#mirror').keyup(function(){ 
        var size = parseInt($(this).attr('size')); 
        var chars = $(this).val().length; 
        if(chars >= size) $(this).attr('size', chars); 
    }); 
}); 

$('#titulopublicar').on('keyup', function() {
 
 var v1 = document.getElementById("titulopublicar").value ;
    
 var find = ["ã","à","á","ä","â","è","é","ë","ê","ì","í","ï","î","ò","ó","ö","ô","õ","ù","ú","ü","û","ñ","ç","#","_","-","/"]; "à","á","ä","â","è","é","ë","ê","ì","í","ï","î","ò","ó","õ","ö","ô","ù","ú","ü","û","ñ","ç","#","_","-","/"
 var replace = ["a","a","a","a","a","e","e","e","e","i","i","i","i","o","o","o","o","o","u","u","u","u","n","c","","","","-"];

    for (var i = 0; i < find.length; i++) {
        v1 = v1.replace(new RegExp(find[i], 'gi'), replace[i]);
    }

    var desired = v1.replace(/\s+/g, '-');
    desired = desired.toLowerCase();

    var v2 = document.getElementById("copia").innerHTML  = desired;
    var v3 = document.getElementById("copia2").value  = desired;
    
});  

	tinymce.init({
  selector: 'textarea#editable',
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
  ],
  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'print preview media | forecolor backcolor emoticons | codesample' });

	
   $('.button-left').click(function(){
       $('.sidebar').toggleClass('fliph');
   });

   (function ($) {
	$.fn.countTo = function (options) {
		options = options || {};
		
		return $(this).each(function () {
			// set options for current element
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from:            $(this).data('from'),
				to:              $(this).data('to'),
				speed:           $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals:        $(this).data('decimals')
			}, options);
			
			// how many times to update the value, and how much to increment the value on each update
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
				increment = (settings.to - settings.from) / loops;
			
			// references & variables that will change with each update
			var self = this,
				$self = $(this),
				loopCount = 0,
				value = settings.from,
				data = $self.data('countTo') || {};
			
			$self.data('countTo', data);
			
			// if an existing interval can be found, clear it first
			if (data.interval) {
				clearInterval(data.interval);
			}
			data.interval = setInterval(updateTimer, settings.refreshInterval);
			
			// initialize the element with the starting value
			render(value);


			
			function updateTimer() {
				value += increment;
				loopCount++;
				
				render(value);
				
				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}
				
				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;
					
					if (typeof(settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}
			
			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.html(formattedValue);
			}
		});
	};
	
	$.fn.countTo.defaults = {
		from: 0,               // the number the element should start at
		to: 0,                 // the number the element should end at
		speed: 1000,           // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,           // the number of decimal places to show
		formatter: formatter,  // handler for formatting the value before rendering
		onUpdate: null,        // callback method for every time the element is updated
		onComplete: null       // callback method for when the element finishes updating
	};
	
	function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	}
}(jQuery));

jQuery(function ($) {
  // custom formatting example
  $('.count-number').data('countToOptions', {
	formatter: function (value, options) {
	  return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
	}
  });
  
  // start all the timers
  $('.timer').each(count);  
  
  function count(options) {
	var $this = $(this);
	options = $.extend({}, options || {}, $this.data('countToOptions') || {});
	$this.countTo(options);
  }
});
     
});

