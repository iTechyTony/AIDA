<?php

include 'config/init.php';

AIDASession::destroySession();

header('Location: index.php');