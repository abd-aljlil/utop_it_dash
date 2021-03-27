var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline-block";
  }
  if (n == (x.length - 1)) {
    //document.getElementById("nextBtn").innerHTML = "Submit";
    document.getElementById("nextBtn").style.display = "none";
    document.getElementById("subBtn").classList.remove("hidden");
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
    document.getElementById("nextBtn").style.display = "inline-block";
    document.getElementById("subBtn").classList.add("hidden");    
  }
  

}
function showProgress(){
    var comp = document.getElementsByClassName("complete").length;
    var x = document.getElementsByClassName("tab").length;
    console.log((comp/x)*100+'%');
      // run spin keyframes with a callback using the shorthand method.
	var $circ = $('.animated-circle');
	var $progCount = $('.progress-count');
        var reachedPercent = 0;

		var circle_offset = 126 * (comp/x);
		$circ.css({
			"stroke-dashoffset" : 126 - circle_offset
		});
		$progCount.html(Math.round((comp/x) * 100) + "%");


}
function nextPrev(n,indicator) {
	  // This function will figure out which tab to display
	  var x = document.getElementsByClassName("tab");
	  // Exit the function if any field in the current tab is invalid:
	  console.log('n:'+ n +':valid:'+ validateForm());
	  if (n == 1 && !validateForm()) return false;
	  if(indicator == 'next'){
			x[currentTab].classList.add("complete");
			showProgress();
	  }
	  // Hide the current tab:
	  x[currentTab].style.display = "none";
	  // Increase or decrease the current tab by 1:
	  currentTab = currentTab + n;
	  // Otherwise, display the correct tab:
	  showTab(currentTab);
  
}

function validateForm() {

    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");		
    y = x[currentTab].getElementsByTagName("input");

  // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is checkbox or radio button...
	 //console.log($(y[0]).attr('type')+'type');
	 if($(y[0]).attr('type')== "checkbox"){
            if(($('div.cr-group :checkbox:checked').length > 0)){
                        valid = true;
                        $('div.cr-group').removeClass("invalid");
                   }else{
                        valid = false;
                        $('div.cr-group').addClass("invalid");

                   }
	 }else{
		$('.mt-radio-list').each(function(){ 
		  if($(this).find('input[type="radio"]:checked').length > 0)
			{
                        valid = true;
                        //console.log($(this).find('input[type="radio"]:checked').length+'dddd');
                        $('.mt-radio-list').removeClass("invalid");
		  }else{
                        valid = false;
                        $('.mt-radio-list').addClass("invalid");  
                        }
		});		 
	 }
	  return valid; // return the valid status
    }
}


  
