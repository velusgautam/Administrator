<script>
    $(function () {
        <?php
        $classSql = "Select class_id, class_name FROM " . TABLE_CLASS . " WHERE status = '0'";
        $classRows = $db->query($classSql);
        while ($classRow = $db->fetch_array($classRows)) {
        ?>


        $("#<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>").click(function () {

            if ($("#<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>:checked").length > 0) {
                $("#<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>").prop("checked", true);
            } else {
                $(".case<?php echo trim(preg_replace('/\s+/', '', $classRow['class_id'])) ?>").removeAttr("checked");
            }

        });
        $(".case<?php echo trim(preg_replace('/\s+/', '', $classRow['class_id'])) ?>").click(function () {

            if ($(".case<?php echo trim(preg_replace('/\s+/', '', $classRow['class_id'])) ?>:checked").length > 0) {

                $("#<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>").prop("checked", true);
            } else {
                $("#<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>").prop("checked", false);
            }

        });
        $("#<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>-icse").click(function () {

            if ($("#<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>-icse:checked").length > 0) {
                $("#<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>-icse").prop("checked", true);
            } else {
                $(".icse<?php echo trim(preg_replace('/\s+/', '', $classRow['class_id'])) ?>").removeAttr("checked");

            }

        });

        $(".icse<?php echo trim(preg_replace('/\s+/', '', $classRow['class_id'])) ?>").click(function () {

            if ($(".icse<?php echo trim(preg_replace('/\s+/', '', $classRow['class_id'])) ?>:checked").length > 0) {
                $("#<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>-icse").prop("checked", true);
            } else {
                $("#<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>-icse").removeAttr("checked");

            }

        });
        $("#<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>-state").click(function () {

            if ($("#<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>-state:checked").length > 0) {
                $("#<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>-state").prop("checked", true);
            } else {
                $(".state<?php echo trim(preg_replace('/\s+/', '', $classRow['class_id'])) ?>").removeAttr("checked");

            }

        });

        $(".state<?php echo trim(preg_replace('/\s+/', '', $classRow['class_id'])) ?>").click(function () {

            if ($(".state<?php echo trim(preg_replace('/\s+/', '', $classRow['class_id'])) ?>:checked").length > 0) {
                $("#<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>-state").prop("checked", true);
            } else {
                $("#<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>-state").removeAttr("checked");

            }

        });


        <?php
        }?>
    });
</script>