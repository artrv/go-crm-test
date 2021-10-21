<?php

include './bootstrap.php';

(new \App())->start($_POST['name'], $_POST['phone']);