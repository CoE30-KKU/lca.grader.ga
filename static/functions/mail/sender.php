<?php
    require_once 'connect.php';

    function sendEmail(String $targetEmail, String $title, String $emailTemplatePath, $variable_replacement) {

        if (!is_array($variable_replacement)) return false;

        $variable = json_encode($variable_replacement);

        global $mailsenderData;
        global $mailconn;
        if ($stmt = $mailconn->prepare("INSERT INTO `mailsystem` (title, sender, receiver, mail, variable) VALUES (?,?,?,?,?)")) {
            $stmt->bind_param('sssss', $title, $mailsenderData, $targetEmail, $emailTemplatePath, $variable);
            $stmt->execute();
            print_r($mailconn->error);
            die();
        }
    }
?>