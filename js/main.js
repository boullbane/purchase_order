jQuery(document).ready(function() {

	// li trick
	$('nav ul li').click(function() {
		$(this).addClass('active').siblings().removeClass('active');
	});
    
	// Placeholder trick
    $('[placeholder]').focus(function() {
        $(this).attr('data-text', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
    }).blur(function() {
        $(this).attr('placeholder', $(this).attr('data-text'));
    });

    //Table datatable
     $('#example').DataTable();

    //Alert auto close
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
    }, 2000);

    // enables multiple selection
    tail.select('#select',{
     multiple: true,
     classNames: 'form-control mr-3',
     placeholder: '...',
     hideDisabled: true,
     search:true,
     multiShowCount: false,
     multiContainer:     true,
    });
});