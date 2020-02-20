<?php
    class Admin
    {
        function generateHash($_pass)
        {
            echo(password_hash($_pass,PASSWORD_DEFAULT));
        }

        function checkAdmin($_name,$_password)
        {
            $admName = "admin";
            $admPass = '$2y$10$vtHsAbfyOjCFd1faMG0JMOIV96cCsu3KSOiHMh7D6JQim28UQoTvG';

            if($_name == $admName && password_verify($_password, $admPass))
            {
                return("ok");
            }
            else
            {
                return("not");
            }
        }

        function logout()
        {
            session_unset();
            session_destroy();
        }

        function login()
        {
            $_SESSION["loggedIn"] = "yep";
        }
    }