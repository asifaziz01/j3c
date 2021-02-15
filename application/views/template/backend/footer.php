<script>
 /* $(function () {
    $('.select2').select2();
  });*/
  function showConfirm(url,msg){
	  var conf = confirm(msg);
	  if(conf){
		document.location.href = url;  
	  }
  }
  function popup(url, width=600, height=600){
	  window.open(url,"print","width="+width+",height="+height)
  }
  
	<?php if(isset($no_sidebar)){?>
		$("body").addClass("sidebar-collapse").trigger("collapsed.pushMenu");
	<?php } ?>
	$('#newsNotify').modal('show');
	$('[data-toggle="tooltip"]').tooltip();

</script>
