<?php
    session_start();
    require_once ('../bootstrap.php');

    require_once (MODEL_PATH . '/orderItem.php');
    require_once (MODEL_PATH . '/proteinBar.php');
    require_once ('../control/process-order.php');
    require_once ('../db/protein-bar-queries.php');
?>