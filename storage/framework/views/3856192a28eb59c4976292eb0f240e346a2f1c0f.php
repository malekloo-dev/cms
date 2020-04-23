<script>
	var menus = {
		"oneThemeLocationNoMenus" : "",
		"moveUp" : "Move up",
		"moveDown" : "Mover down",
		"moveToTop" : "Move top",
		"moveUnder" : "Move under of %s",
		"moveOutFrom" : "Out from under  %s",
		"under" : "Under %s",
		"outFrom" : "Out from %s",
		"menuFocus" : "%1$s. Element menu %2$d of %3$d.",
		"subMenuFocus" : "%1$s. Menu of subelement %2$d of %3$s."
	};
	var arraydata = [];     
	var addcustommenur= '<?php echo e(route("haddcustommenu")); ?>';
	var updateitemr= '<?php echo e(route("hupdateitem")); ?>';
	var generatemenucontrolr= '<?php echo e(route("hgeneratemenucontrol")); ?>';
	var deleteitemmenur= '<?php echo e(route("hdeleteitemmenu")); ?>';
	var deletemenugr= '<?php echo e(route("hdeletemenug")); ?>';
	var createnewmenur= '<?php echo e(route("hcreatenewmenu")); ?>';
	var csrftoken="<?php echo e(csrf_token()); ?>";
	var menuwr = "<?php echo e(url()->current()); ?>";

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': csrftoken
		}
	});
</script>
<script type="text/javascript" src="<?php echo e(asset('vendor/harimayco-menu/scripts.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('vendor/harimayco-menu/scripts2.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('vendor/harimayco-menu/menu.js')); ?>"></script><?php /**PATH O:\xampp\htdocs\live-chat\resources\views/vendor/wmenu/scripts.blade.php ENDPATH**/ ?>