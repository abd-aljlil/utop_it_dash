function maketoast(priority , title , message)
{
	/*
    var priority = 'success';
    var title    = 'Success';
    var message  = 'It worked!';
	*/
    $.toaster({ priority : priority, title : title, message : message });
}