(function ($) {
Drupal.behaviors.myBehavior = {
  attach: function (context, settings) {
    
        var inputData = settings.views.animateSlider;

        console.log(inputData);

        var field_labels = inputData.field_labels;

        var outputData = {};
        
        var id=[];
        
        var details={};
        
        for(var i=0;i<inputData.field_labels.length;i++){
            id='#animate-'+field_labels[i];
            var transitionData = {show:inputData.transitions[field_labels[i]].$showTransition,hide:'rotateOut',delayShow : "delay"+inputData.transitions[field_labels[i]].delay+"s"};
            details[id]=transitionData;
    }

            
        for(var i=0;i<inputData.count_rows;i++){
            outputData[i] = details;
        }
        
        
        //console.log(inputData);
        console.log(outputData);
        
        $(".anim-slider").animateSlider(
		 	{
		 		autoplay	: inputData.autoplay,
		 		interval	: inputData.interval,
		 		animations 	: outputData
		 	});
  }
};
})(jQuery);