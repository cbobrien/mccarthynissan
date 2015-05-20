<script>
	function confirmSubmit(frm) {
		console.log(frm);
		var agree = confirm('Are you sure you wish to delete this?');
		if (agree)
		    document.forms[frm].submit();
		else
		    return false;
	}
</script>