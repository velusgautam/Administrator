
<script>
$(function(){
	<?php
			$classSql = "Select class_id, class_name FROM " . TABLE_CLASS . " WHERE status = '0'";
		    $classRows = $db->query($classSql);
			while ($classRow = $db->fetch_array($classRows)) {
								?>
 $("input[name^='<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>-']").keyup(function(){

        if(this.value > 0) {
           $(".<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>").prop( "checked", true );
        } else if(this.value == 0 &&  document.getElementById("<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>-1").value == 0 &&  document.getElementById("<?php echo trim(strtolower(preg_replace('/\s+/',
         '', $classRow['class_name']))) ?>-2").value == 0) {
            $(".<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>").removeAttr("checked");
        }
	 if(this.value == '' || this.value == ' ')
	    this.value = 0;
 
    });
	<?php
	}?>
	});
		</script>