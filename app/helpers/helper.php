<?php

function redirect($url)
{
    header('location:' . PROJECT_URL . $url);
}