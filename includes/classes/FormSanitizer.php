<?php
class FormSanitizer {

    public static function sanitizeFormString($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = trim($inputText);
        $inputText = strtolower($inputText);
        $inputText = ucfirst($inputText);
        return $inputText;
    }

    public static function sanitizeFormUsername($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        return $inputText;
    }

    public static function sanitizeFormPassword($inputText) {
        $inputText = strip_tags($inputText); // Strips any HTML tags
        // Here, you could add further sanitization if necessary, but for passwords, 
        // only basic stripping of tags and trimming is usually needed.
        return trim($inputText); // Ensure there are no leading or trailing spaces
    }

    public static function sanitizeFormEmail($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText); // Removes spaces
        // Additional validation can be added here (e.g., regex or filter_var)
        return $inputText;
    }
}
?>