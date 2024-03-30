jQuery(document).ready(function($){
	$('.hide-password').on('click', function(){
		var $this= $(this),
			$password_field = $this.prev('input');
		
		( 'password' == $password_field.attr('type') ) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
		( 'Скрыть' == $this.text() ) ? $this.text('Показать') : $this.text('Скрыть');
	});
});