(function ($) {
Drupal.behaviors.myBehavior = {
  attach: function (context, settings) {
    
        var inputData = settings.views.animateSlider;

        var field_labels = inputData.field_labels;

        var outputData = {};
        
        var id=[];
        
        var details={};
        
        for(var i=0;i<inputData.field_labels.length;i++){
            id='#animate-'+field_labels[i];
            var transitionData = {show:inputData.transitions[field_labels[i]].$showTransition,hide:inputData.transitions[field_labels[i]].$hideTransition,delayShow : "delay1s"}
            details[id]=transitionData;
    }

            
        for(var i=0;i<inputData.count_rows;i++){
            outputData[i] = details;
        }
        
   $(".anim-slider").animateSlider(
		 	{
		 		autoplay	:inputData.$AutoPlay,
		 		interval	:inputData.$Interval,
		 		animations 	: outputData,
		 	});
  }
};
})(jQuery);