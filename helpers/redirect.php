<?php


    function redirect($redirectTo = '/') {
        return header('Location:'. $redirectTo);
    }